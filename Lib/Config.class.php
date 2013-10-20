<?php
class Config
{

	public static $config = array();

	public static get($key)
	{
		return isset(self::$config[$key]) ? self::$config[$key] : null;
	}

	public static set($key,$value=null)
	{
		if(is_array($key)) 
			self::$config = array_merge(self::$config,$key);
		else
			self::$config[$key] = $value;
	}
}