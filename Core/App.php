<?php
class App extends Core 
{
	public static $controller = null;

	public static $log_data = array();

	public static $config = array();
	
	public static function init()
	{
		import('Common','func');
		import('Security','func');
		import('Out');

		$_POST   = escape_string($_POST);
		$_GET    = escape_string($_GET);
		$_COOKIE = escape_string($_COOKIE);
		$_FILES  = escape_string($_FILES);	
	}
	
	public static function Action($controller=null,$action=null)
	{
		$controller = (is_null($controller)) ?  Controller.'Controller' : $controller.'Controller';
	    $action = (is_null($action)) ?  ACTION.'Action' : $action.'Action';
	    $controller_path = ROOT.'/'.$Config['APP_DIR'].'/'.$controller.'.php';
		
	    (!is_file($controller_path)) && exit('不存在此应用程序');
	    
	    include_once($controller_path);
	    
		$controller_class = (strrchr($controller,'/') !== false) ? substr(strrchr($controller,'/'),1) : $controller ;
		
	    if (class_exists($controller_class)) 
	        self::$controller = new $controller_class;
	    else 
	        exit('不存在此应用程序相对应的类程序，请先创建');
		
	    if (!method_exists(self::$controller,$action))
	        exit('此应用程序的对象不存在此方法，请先创建');

	    self::$controller->$action();
	}
	
	public static function run($config)
	{
		self::$config = $config;

		self::init();

		self::Action(CONTROLLER,ACTION);

		M(null,'clear');
	}
}