<?php
return array(
	'DEFAULT_TIME_ZONE'=>'Asia/Shanghai',

	'HOST'=>'http://localhost/pqframe',

	'APP_NAME'=>'网站名称',

	//cookie设置
	'COOKIE_PRE'=>'pq_',

	'COOKIE_DOMAIN'=>'',

	'COOKIE_PATH'=>'/',

	//确定目录
	'APP_DIR'=>'Controller',

	'API_DIR'=>'Controller',

	'MODEL_DIR'=>'Model',

	'VIEW_DIR'=>'View',

	//确定模块名称
	'DEFAULT_MODULE'=>'app',

	'DEFAULT_CONTROLLER'=> 'index',
	
	//开启debug
	'DEBUG'=>true,

	//数据库连接
	'DB' => array(
		'MAIN'=> array(
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