<?php
  // 核心类  启动类  // 初始化配置信息
 
  class Framework {
    // 入口
   
    public static function run(){
      // 
     self::init();

     self::autoload();

     self::router();
    }
    // 初始化方法
    public static  function  init(){
      // 定义当前路径 getcwd()
      define('DS',DIRECTORY_SEPARATOR); //在Linux下是 “/ ”,在window下 是 “\”
      define('ROOT',getcwd() .DS);  // 定义根路径
      define('APP_PATH',ROOT. 'application' . DS);  // 应用程序路径
      define('FRAMEWORK_PATH',ROOT. 'framework' . DS);  //框架路径
      define('PUBLIC_PATH',ROOT. 'public' . DS);  // 静态文件路径

      define('MODEL_PATH',APP_PATH. 'models' . DS);  // 模型路径
      define('CONTROLLER_PATH',APP_PATH. 'controllers' . DS);  // 控制器路径
      define('VIEW_PATH',APP_PATH. 'views' . DS);  // 视图路径
      define('CONFIG_PATH',APP_PATH. 'config' . DS);  // 配置文件路径

      define('CORE_PATH',FRAMEWORK_PATH. 'core' . DS);  // 核心路径
      define('DB_PATH',FRAMEWORK_PATH. 'database' . DS);  // 数据驱动路径
      define('HELPER_PATH',FRAMEWORK_PATH. 'helpers' . DS);  // 辅助类路径
      define('LIB_PATH',FRAMEWORK_PATH. 'libraries' . DS);  // 配置文件路径

      // 前后台控制器 视图怎么定义？
      define('PLATFORM', isset($_REQUEST['p']) ? $_REQUEST['p']:'home');
      define('CONTROLLER', isset($_REQUEST['c'])? ucfirst($_REQUEST['c']):'Index'); //ucfirst 首字母大写
      define('ACTION', isset($_REQUEST['a']) ? $_REQUEST['a']:'index');
      
      define('CUR_CONTROLLER_PATH', CONTROLLER_PATH . PLATFORM .DS); //当前控制器路径
      define('CUR_VIEW_PATH', VIEW_PATH . PLATFORM .DS); //当前视图路径

      

      // 手动载入核心类
      require CORE_PATH .'Controller.class.php';
      require CORE_PATH .'Model.class.php';
      require DB_PATH .'Mysql.class.php';

      require LIB_PATH  . 'Captcha.class.php';

      // 载入配置文件 存入全局变量
     $GLOBALS['config'] =  include CONFIG_PATH . 'config.php';
   
    } 

    // 路由方法
    public static  function  router(){
      // 确定类名和方法名
      $controller_name = CONTROLLER . 'Controller'; //如: GoodsController
      $action_name = ACTION . 'Action'; //如: addAction
      // 实例化控制器，调用相应的方法

      $controller = new $controller_name();
      $controller->$action_name();
    }
    // 自动加载
    public static  function autoload(){
       // __CLASS__代表类名
       // self 代表类结构
      spl_autoload_register(array(__CLASS__,'load'));
    }
    // 加载
    public static  function load($classname){
      // 只负责加载 application下面的控制器类和模型类 如 GoodsController
      if(substr($classname,-10) == 'Controller'){
        require CUR_CONTROLLER_PATH . "{$classname}.class.php";
      }else if(substr($classname,-5) == 'Model'){
        require MODEL_PATH . "{$classname}.class.php";
      }else{
        // 其他情况 暂无

      }



    }
  }