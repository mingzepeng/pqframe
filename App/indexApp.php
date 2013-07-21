<?php
class indexApp extends App
{
	public $_name = 'index';

	public function __construct()
	{
		parent::__construct();
		if(self::$view)
		{
			$module_dir = self::$view->template_dir.'/'.self::$view->module;
			$this->setConfig('css_dir',$module_dir.'/css');
			$this->setConfig('js_dir',$module_dir.'/js');
			$this->setConfig('image_dir',$module_dir.'/images');
		}
	}

	public function indexAction()
	{
		$this->display('index');
	}
}