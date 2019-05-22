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


/***
 * 自动加载函数
 * 
 * 
 */ 
 function  userAutoload($class_name){
   var_dump($class_name);
    // 先处理确定的  框架中 核心类 
    // 定义类名与类文件映射的数组
    $framework_class_list = array(
      // 类名=>类文件
      'Controller'=> './framework/Controller.class.php',
      'Model'=> './framework/Model.class.php',
      'Factory'=> './framework/Factory.class.php',
      'MysqlDB'=> './framework/MysqlDB.class.php'
    );
    // 判断是否为核心类
    if(isset($framework_class_list[$class_name])){

      require $framework_class_list[$class_name];

    }else if(substr($class_name,-10) == 'Controller'){ //MatchController
    // 在处理是否为可增加的 （控制类，模型类）
    // 控制器类 截取后10个字符串 是否==Controller

      // 控制器类 ，当前平台下的Controller类
      require './application/' . PLATFORM . '/Controller/'. $class_name .'.class.php';


    }else if(substr($class_name,-5) == 'Model'){ //MatchModel
       // 模型类 ，当前平台下的Model类
       require './application/' . PLATFORM . '/Model/'. $class_name .'.class.php';

    }


 }
 spl_autoload_register('userAutoload');


// 定义常量存储分发参数，防止参数被修改
$default_platform = 'test'; //平台分发
define('PLATFORM',isset($_GET['p'])?$_GET['p']: $default_platform);
$default_controller = 'Match';
define('CONTROLLER',isset($_GET['c'])?$_GET['c']: $default_controller);
$default_action = 'list';
define('ACTION',isset($_GET['a'])?$_GET['a']: $default_action);


$controller_name = CONTROLLER .'Controller';


// 实例化
$controller = new $controller_name(); //可变量

// 调用方法
$action_name = ACTION . 'Action';
$controller->$action_name(); //可变方法

