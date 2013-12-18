<?php
/**
 * -------------------------------------------
 * 视图类，实现了基本的视图操作
 * --------------------------------------------
 * @author pmz(mingzepeng@gmail.com)
 * @version 1.0  2012.8.30
 */
class View extends Core
{	
	protected $data = array();

	protected $page = array();

    protected $config = array();              
   
    //视图文件夹名称
    protected $view_dir = '';

    //当前模块
    protected $module = '';
    

    //缓存设置  
    public $cache_dir = '';
    
    public $cache_lift_time = 0;
    

    
    //默认模板名
    public $default_template = 'index';
    
    public $default_template_type = 'html';
    
    //输出方式 put,get
    public $display_modern = 'put'; 
           
    public function __construct($view_dir,$module)
    {
        $this->view_dir = $view_dir;
        if (is_dir(ROOT.SEP.$view_dir))
		{
			$this->setConfig('common_dir', $this->view_dir .'/common');
			$this->setConfig('common_css_dir', $this->view_dir .'/common/css');
			$this->setConfig('common_js_dir', $this->view_dir .'/common/js');
			$this->setConfig('common_image_dir', $this->view_dir .'/common/images');
		}
        $this->setModule($module);
    }
    
	public function assign($key,$value=null)
	{
		if (!is_array($var))
			$this->data[$var] = $value;
		else 
			$this->data = array_merge($this->data,$key);	
	}
	
	public function setPage($var,$value=null)
	{
		if (!is_array($var))
			$this->page[$var] = $value.'.'.$this->default_template_type;
		else 
			foreach ($var as $key => $val) $this->page[$key] = $val.'.'.$this->default_template_type;
	}
	
	public function setConfig($var,$value=null)
	{
		if(!is_array($var))
			$this->config[$var] = $value;	
		else
			$this->config = array_merge($this->config,$var);
	}
	
	public function setModule($module)
	{
		$this->module = $module;
		if (is_dir(ROOT.SEP.$this->view_dir.SEP.$this->module))
		{
			$module_path = $this->view_dir.'/'.$this->module;
			$this->setConfig('dir',$module_path);
			$this->setConfig('css_dir',$module_path.'/css');
			$this->setConfig('js_dir',$module_path.'/js');
			$this->setConfig('image_dir',$module_path.'/images');
		}
	}

	/**
	 *
	 * @param string $file
	 * @param string $type = get put
	 */
    public function display($template='', $type='put')
    {   	
    	if ($type === '') $type = $this->display_modern;
    	if ($template === '')  $template = $this->default_template;
    	$template = $this->view_dir.'/'.$this->module.'/'.$template.'.'.$this->default_template_type;
    	//var_dump($template);
        if(!is_file($template)) $this->error('template:'.$template.' no exists');
        
        import('Page');
        Page::$config = $this->config;
        Page::$page = $this->page;
        Page::$data = $this->data;
    	extract($this->data);
    	header("Content-type: text/html; charset=utf-8");
    	ob_start();
        include($template);
        $contents = ob_get_clean();
		
    	if ($type === 'put')
    	{
    		echo $contents;
	  		if(Config::get('DEBUG') && !empty(Controller::$log_data))
			{
				$log_data = array('log'=>array_map('urlencode_deep',Controller::$log_data));
				//var_dump($log_data);
				$log_data = urldecode(json_encode($log_data));
				//var_dump(Controller::$log_data);
				//$log_file = ROOT.'/Lib/log.inc.php';
				import("log","inc");
			}
    		return true;
    	}
    	elseif ($type === 'get')
    	{
    		return $contents;
    	}
	}
	
	public function generateCache($contents='',$cache='',$callback='log')
	{
		if(is_writable($this->cache_dir))
		{
		    if ($cache == '') $cache = $this->nameCache();
		    $cache = $this->cache_dir.'/'.$cache.'.html';
		    return (file_put_contents($cache,$contents) > 0) ? true : false;
		}
		else
		{
			$this->$callback('no permission to create cache '.$cache);
			return false;
		}
	}
	
	public function cacheExist($cache='')
	{
	    if ($cache == '') $cache = $this->nameCache();
		$cache = $this->cache_dir.'/'.$cache.'.html';
		return is_file($cache);
	}
	
	public function displayCache($cache='')
	{
	    if ($cache === '') $cache = $this->nameCache();
		$cache = $this->cache_dir.'/'.$cache.'.html';
		include($cache);	    
	}
	
	public function nameCache()
	{
	    return APP.'.'.ACTION;
	}
	
}