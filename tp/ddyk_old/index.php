<?php


// 指定允许其他域名访问
header('Access-Control-Allow-Origin:*');
// 响应类型
header("Access-Control-Allow-Methods:GET, POST, OPTIONS, DELETE");
// 响应头设置
//header('Access-Control-Allow-Headers:x-requested-with,content-type');
header("Access-Control-Allow-Headers:DNT,X-Mx-ReqToken,Keep-Alive,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type, Accept-Language, Origin, Accept-Encoding");
//设置字符集
header("content-type:text/html;charset=utf-8");

//全局配置 地址路径
// define('SITE_URL','http://47.94.249.58/ddyk/Public/Uploads/');
// define('SITE_URLHead','http://47.94.249.58/ddyk/Public/MemberHead/');
// define('SITE_URLShop','http://47.94.249.58/ddyk/Public/ShopMember/');
// define('SITE_URLTwo','http://47.94.249.58/ddyk/Public/Upload/');
// define('SITE_URLRoot','http://47.94.249.58');
// 定义应用程序的目录
// 开启调试
define('APP_DEBUG',true);

// 定义应用程序入口
define('APP_PATH','./application/');



// 引入 thinkphp  入口 文件

require './ThinkPHP/ThinkPHP.php';


