<?php

// 框架初始化功能类

class Framework {

  // 入口

  public static function  run(){
    // 声明路径常量
    static::_initPathConst();
    // 初始化配置信息
    static:: _initConfig();
    // 初始化分发参数
    static::_initDispatchParam();
     // 声明当前平台路径常量
    static::_initPlatformConst();
      // 注册自动加载
    static::_initAutoload();  
    // 分发请求
    static::_dispatch();
  }
 
  // 声明路径常量
  private static function  _initPathConst(){
    define('ROOT_PATH',getcwd().'/'); //根目录
    define('APPLICATION_PATH',ROOT_PATH .'application/'); //应用程序目录
    define('FRAMEWORK_PATH',ROOT_PATH .'framework/');  // 框架目录
    define('TOOL_PATH',FRAMEWORK_PATH .'tool/');  // 工具类目录
    define('CONFIG_PATH',APPLICATION_PATH .'config/');// 配置信息路径
  }


// 初始化配置信息

  private static function _initConfig(){
    //  $GLOBALS['config'] 超全局变量 可以全局调用
    $GLOBALS['config']=  require CONFIG_PATH . 'application.config.php';

  }


  // 初始化分发参数
  private static function  _initDispatchParam(){
    
    // 获取默认平台
    $default_platform =  $GLOBALS['config']['app']['default_platform'] ; //平台分发
    define('PLATFORM',isset($_GET['p'])?$_GET['p']: $default_platform);

    // 获取默认平台下的控制器
    $default_controller = $GLOBALS['config'][PLATFORM]['default_controller'];
    define('CONTROLLER',isset($_GET['c'])?$_GET['c']: $default_controller);

    // 获取默认平台下的动作
    $default_action = $GLOBALS['config'][PLATFORM]['default_action'];
    define('ACTION',isset($_GET['a'])?$_GET['a']: $default_action);
  }

  // 声明当前平台路径常量
  private static function  _initPlatformConst(){
    define('CURRENT_CONTROLLER_PATH',APPLICATION_PATH . PLATFORM . '/Controller/'); //控制器目录
    define('CURRENT_MODEL_PATH',APPLICATION_PATH . PLATFORM . '/Model/'); //模型目录
    define('CURRENT_VIEW_PATH',APPLICATION_PATH . PLATFORM . '/View/'); //视图目录
  }
  // 自动加载
  // 用public 是因为 不确定在哪调用 
  public static function userAutoload($class_name){
      // 定义类名与类文件映射的数组
      $framework_class_list = array(
        // 类名=>类文件
        'Controller'=> FRAMEWORK_PATH . 'Controller.class.php',
        'Model'=> FRAMEWORK_PATH .'Model.class.php',
        'Factory'=> FRAMEWORK_PATH .'Factory.class.php',
        'MysqlDB'=> FRAMEWORK_PATH .'MysqlDB.class.php',
        'SessionDB'=> TOOL_PATH .'SessionDB.class.php',
        'Captcha' => TOOL_PATH . 'Captcha.class.php'
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
  // 注册自动加载
  private static function _initAutoload(){
    // __CLASS__代表类名
    // self 代表类结构
    spl_autoload_register(
      array(__CLASS__,'userAutoload')
    );
  }
  // 实例化控制器 分发请求
  private static function _dispatch(){

    $controller_name = CONTROLLER .'Controller';
    // 实例化
    $controller = new $controller_name(); //可变量

    // 调用方法
    $action_name = ACTION . 'Action';
    $controller->$action_name(); //可变方法

  }

}