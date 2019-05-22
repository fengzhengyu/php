<?php
/**
 *目录常量
 */ 
define('ROOT_PATH',getcwd().'/'); //根目录
define('APPLICATION_PATH',ROOT_PATH .'application/'); //应用程序目录
define('FRAMEWORK_PATH',ROOT_PATH .'framework/');  // 框架目录

/***
 * 自动加载函数
 * 
 * 
 */ 
 function  userAutoload($class_name){
  //  var_dump($class_name);
    // 先处理确定的  框架中 核心类 
    // 定义类名与类文件映射的数组
    $framework_class_list = array(
      // 类名=>类文件
      'Controller'=> FRAMEWORK_PATH . 'Controller.class.php',
      'Model'=> FRAMEWORK_PATH .'Model.class.php',
      'Factory'=> FRAMEWORK_PATH .'Factory.class.php',
      'MysqlDB'=> FRAMEWORK_PATH .'MysqlDB.class.php'
    );
    // 判断是否为核心类
    if(isset($framework_class_list[$class_name])){

      require $framework_class_list[$class_name];

    }else if(substr($class_name,-10) == 'Controller'){ //MatchController
    // 在处理是否为可增加的 （控制类，模型类）
    // 控制器类 截取后10个字符串 是否==Controller

      // 控制器类 ，当前平台下的Controller类
      require CURRENT_CONTROLLER_PATH . $class_name .'.class.php';


    }else if(substr($class_name,-5) == 'Model'){ //MatchModel
       // 模型类 ，当前平台下的Model类
       require CURRENT_MODEL_PATH . $class_name .'.class.php';

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

// 当前平台的常量
define('CURRENT_CONTROLLER_PATH',APPLICATION_PATH . PLATFORM . '/Controller/'); //控制器目录
define('CURRENT_MODEL_PATH',APPLICATION_PATH . PLATFORM . '/Model/'); //模型目录
define('CURRENT_VIEW_PATH',APPLICATION_PATH . PLATFORM . '/View/'); //视图目录






$controller_name = CONTROLLER .'Controller';


// 实例化
$controller = new $controller_name(); //可变量

// 调用方法
$action_name = ACTION . 'Action';
$controller->$action_name(); //可变方法

