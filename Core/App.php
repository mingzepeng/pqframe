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
		// todo  need a secure function to filter gpc
		if(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc())
		{
			$_POST   = stripslashes_deep($_POST);
			$_GET    = stripslashes_deep($_GET);
			$_COOKIE = stripslashes_deep($_COOKIE);
			$_FILES  = stripslashes_deep($_FILES);				
		}
	}
	
	public static function Action($module,$controller,$action)
	{
		$controller .= 'Controller';
	    $action .= 'Action';
	    $controller_path = ROOT.SEP.Config::get('APP_DIR').SEP.$module.SEP.$controller.'.php';
		
	    (!is_file($controller_path)) && exit('不存在此应用程序');
	    
	    include_once($controller_path);
	    
		$controller_class = (strrchr($controller,'/') !== false) ? substr(strrchr($controller,'/'),1) : $controller ;
		
	    if (class_exists($controller_class)) 
	        self::$controller = new $controller_class;
	    else 
	        exit('不存在此应用程序相对应的类程序，请先创建');
		
	    if (!method_exists(self::$controller,$action))
	        exit('此应用程序的对象不存在此方法，请先创建');
	    Controller::$view = new View(Config::get('VIEW_DIR'),$module);
	    self::$controller->$action();
	}
	
	public static function run($module,$controller,$action)
	{
		self::init();
		self::Action($module,$controller,$action);
	}
}