<?php
return array(
	//'配置项'=>'配置值'
	'TMPL_L_DELIM' => '<{',
	'TMPL_R_DELIM' => '}>',

	// 连接数据库
	'DB_TYPE'               =>  'mysql',     // 数据库类型
	'DB_HOST'               =>  'localhost', // 服务器地址
	'DB_NAME'               =>  'demo_rbac',          // 数据库名
	'DB_USER'               =>  'root',      // 用户名
	'DB_PWD'                =>  'root',          // 密码
	'DB_PORT'               =>  '3306',        // 端口
	'DB_PREFIX'             =>  'demo_',    // 数据库表前缀


	//'DEFAULT_MODULE'        => 'Admin', //默认 分组 
	'MODULE_ALLOW_LIST'     => array('Admin','Home','Api'),  //允许的分组
);