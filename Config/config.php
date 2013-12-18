<?php

//全局配置文件

return array(

	//开启debug
	'DEBUG'=>true,

	'DEFAULT_TIME_ZONE'=>'Asia/Shanghai',

	'HOST'=>'http://localhost/pqframe',

	'APP_NAME'=>'pqframe',

	//cookie设置
	'COOKIE_PRE'=>'pq_',

	'COOKIE_DOMAIN'=>'',

	'COOKIE_PATH'=>'/',

	//确定目录
	'APP_DIR'=>'Controller',

	'MODEL_DIR'=>'Model',

	'VIEW_DIR'=>'View',

	//确定模块名称
	'DEFAULT_MODULE'=>'app',

	'DEFAULT_CONTROLLER'=> 'index',
	


	//数据库连接
	'DB' => array(
		'MAIN'=> array(
			
			'DB_TYPE'=>'mysql',

			'DB_HOST'=>'localhost',

			'DB_USER'=>'root',

			'DB_PASSWORD'=>'',

			'DB_CHARSET'=>'utf8',

			'DB_NAME'=>'pqframe',

			'DB_TABLE_PRE'=>'jh_',

			'PCONNECT'=>0,
		)
	)
);