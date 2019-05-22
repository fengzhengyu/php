<?php
// 调用一个控制器
// require './MatchController.class.php';
// $controller = new MatchController();
// $controller->listAction();
// 以上不灵活 ，多个控制器还学写多个index.php


// 确定分发参数
// $c = isset($_GET['c'])?$_GET['c']: 'Match';
// $a = isset($_GET['a'])?$_GET['a']: 'list';
// $controller_name = $c .'Controller';
// $action_name = $a.'Action';
// 以上灵活，但变量不能保证不被修改



// 定义常量存储分发参数，防止参数被修改
define('CONTROLLER',isset($_GET['c'])?$_GET['c']: 'Match');
define('ACTION',isset($_GET['a'])?$_GET['a']: 'list');


$controller_name = CONTROLLER .'Controller';
// 引入控制器
require './application/test/Controller/'.$controller_name.'.class.php';

// 实例化
$controller = new $controller_name(); //可变量

// 调用方法
$action_name = ACTION . 'Action';
$controller->$action_name(); //可变方法

