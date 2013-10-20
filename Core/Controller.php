<?php
abstract class Controller extends Core
{	
	public static $view = null;
	
	public function display($file='',$type='put')
	{
		if (self::$view instanceof View) return self::$view->display($file,$type);
	}
	
	public function assign($key=null,$value=null)
	{
		if (self::$view instanceof View) self::$view->assign($key,$value);
	}

	public function assignPage($page=null,$value=null)
	{
		if (self::$view instanceof View) self::$view->assignPage($page,$value);
	}

	public function setViewConfig($config=null,$value=null)
	{
		if (self::$view instanceof View) self::$view->setConfig($config,$value);
	}
	
	public function setModule($module)
	{
		if (self::$view instanceof View) self::$view->setModule($module);
	}
	
	public function directTo($controller='index',$action='index',$params=array(),$enter='index')
	{
		$url = U($controller,$action,$params,$enter);
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