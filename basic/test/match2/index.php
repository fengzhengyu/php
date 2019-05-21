<?php
// 确定分发参数
$a = isset($_GET['a'])?$_GET['a']: 'list';


// 引入控制器
require './MatchController.class.php';

// 实例化
$controller = new MatchController();

// 调用方法
// $controller->listAction();

$action_name = $a.'Action';
$controller->$action_name();

