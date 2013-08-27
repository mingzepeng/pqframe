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
	public $_name = 'View';
	
	public $data = array();

    public $config=array();              
   
    //模板文件夹
    public $template_dir = '';
                     
    public $cache_dir = '';
    
    public $cache_lift_time = 0;
    
    //当前主题
    public $module = '';
    
    //默认模板名
    public $default_template = 'index';
    
    public $default_template_type = 'html';
    
    public $display_modern = 'put';    //put get
           
    public function __construct()
    {
        
    }
    
	public function assign($var=null,$value=null)
	{
		if ($var == null) return;
		if (!is_array($var))
			$this->data[$var] = $value;
		else 
			$this->data = array_merge($var,$this->data);	
	}
	
	public function assignPage($var=null,$value=null)
	{
		$this->assign($var,$value.'.'.$this->default_template_type);
	}
	
	public function setConfig($var=null,$value=null)
	{
		if($var==null) return;
		if(!is_array($var))
			$this->config[$var] = $value;	
		else
			$this->config = array_merge($var,$this->config);
	}
	
	public function setModule($module)
	{
		if (isset($module)) $this->module = $module;
	}
	
	public function before_init()
	{

	}
	
	public function after_init()
	{

	}

	/**
	 * 
	 *
	 * @param string $file
	 * @param string $type = get put
	 */
    public function display($template='', $type='put')
    {
    	$this->before_init();    	
    	if ($type === '') $type = $this->display_modern;
    	if($template === '')  $template = $this->default_template;
    	$template = $this->template_dir.'/'.$this->module.'/'.$template.'.'.$this->default_template_type;
        if(!is_file($template)) $this->error('template:'.$template.' no exists');
        
        import('Page');
        Page::$config = $this->config;
    	extract($this->data);
    	header("Content-type: text/html; charset=utf-8");
    	ob_start();
        include($template);
        $contents = ob_get_clean();
    	$this->after_init();
		
    	if ($type === 'put')
    	{
    		echo $contents;
	  		if(DEBUG && !empty(Controller::$log_data))
			{
				$log_data = array('log'=>array_map('urlencode_deep',Controller::$log_data));
				//var_dump($log_data);
				$log_data = urldecode(json_encode($log_data));
				//var_dump(Controller::$log_data);
				$log_file = ROOT.'/Lib/log.inc.php';
				include($log_file);
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