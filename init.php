<?php
error_reporting(E_ALL | E_NOTICE);

define('IN',true);

session_start(); 

include("Lib/Config.class.php");

Config::set(include('Config/config.php'));

//设置区域时间
date_default_timezone_set(Config::get('DEFAULT_TIME_ZONE')); 

define('START_TIME',time());


define('SEP', DIRECTORY_SEPARATOR);

//设置根目录
define('ROOT',dirname(__FILE__));

//设置日期
define('DATE',date('Y-m-d',START_TIME));

define('TIME',date('H:i:s',START_TIME));

define('DATETIME',DATE.' '.TIME);

//加载必备文件
include('Core/Core.php');
include('Lib/Core.func.php');
include('Core/Model.php');
include('Core/View.php');
include('Core/Controller.php');
include('Core/App.php');
