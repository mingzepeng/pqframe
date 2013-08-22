<?php
class App extends Core
{
	public $_name = 'App';	
	
	public static $view = null;
	
	public function __construct()
	{

	}
	public function display($file='',$type='put')
	{
		if (self::$view instanceof View) return self::$view->display($file,$type);
	}
	
	public function assign($var=null,$value=null)
	{
		if (self::$view instanceof View) self::$view->assign($var,$value);
	}

	public function assignPage($var=null,$value=null)
	{
		if (self::$view instanceof View) self::$view->assignPage($var,$value);
	}
		
	public function setConfig($var=null,$value=null)
	{
		if (self::$view instanceof View) self::$view->setConfig($var,$value);
	}
	
	public function setModule($module)
	{
		if (self::$view instanceof View) self::$view->setModule($module);
	}
	
	public function directTo($app='index',$action='index',$params=array(),$enter='index')
	{
		$url = U($app,$action,$params,$enter);
		header("Location:{$url}");
	}

	public function log($var,$value=null)
	{
		if(is_array($var)) 
			Controller::$log_data = array_merge(Controller::$log_data,$var);
		elseif($value === null)
		{
			Controller::$log_data[] = $var;
		}
		else
		{
			Controller::$log_data[$var] = $value;
		}
	}
}