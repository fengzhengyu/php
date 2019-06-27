<?php
return array(
	//'配置项'=>'配置值'

	'TMPL_L_DELIM' => '<{',
	'TMPL_R_DELIM' => '}>',
	
	
    //数据库配置信息
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'   => 'ddyk_old', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => 'root', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => 'ddold_', // 数据库表前缀
    'DB_CHARSET'=> 'utf8', // 字符集
    // 'DB_PARAMS' => array(\PDO::ATTR_CASE => \PDO::CASE_NATURAL),//数据库字段按表里原样显示

        
    // 'URL_CASE_INSENSITIVE'  => false,        // 默认false 表示URL区分大小写 true则表示不区分大小写
    // 'URL_MODEL'             => 2,           // URL模式
    // 'URL_PATHINFO_DEPR'     => '/',         // PATHINFO URL分割符
    // 'URL_ROUTER_ON'         => false,       // 是否开启URL路由
    // 'URL_ROUTE_RULES'       => array(),     // 默认路由规则 针对模块
);