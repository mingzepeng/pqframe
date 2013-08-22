<?php
if (!defined('IN')) die('access deined');
class Out
{
	const succes = 'success';
	
	const error = 'error';
	
	const fail = 'fail';
	
	const warn = 'warn';

	public static $log_data = array();

	public static function log($var,$value=null)
	{
		if(is_array($var)) 
			self::$log_data = array_merge(self::$log_data,$var);
		elseif($value === null)
			self::$log_data[] = $var;
		else
			self::$log_data[$var] = $value;
	}

	public static function ajaxSuccess($info,$data=null)
	{
	    self::ajaxOut(self::succes,$info,$data);
	}
	
	public static function ajaxFail($info,$data=null)
	{
		self::ajaxOut(self::fail,$info,$data);
		exit;
	}

	public static function ajaxWarn($info,$data=null)
	{
	    self::ajaxOut(self::warn,$info,$data);
	}
	
	public static function ajaxError($info,$data=null)
	{
		self::ajaxOut(self::error,$info,$data);
		exit;
	}

	public static function ajaxOut($state,$info,$data=null)
	{
		//$info = urlencode($info);
		$out = array('state'=>$state , 'info'=>$info);
		if($data !== null) $out['data'] = $data;
		if(!empty(self::$log_data)) $out['log'] = self::$log_data;
		$out = array_map('urlencode_deep', $out);
		header("Content-type: text/html; charset=utf-8");
		$json = urldecode(json_encode($out));
		echo $json;
	}
}

?>