<?php

  // 平台控制器

  class PlatformController extends Controller {

    public function __construct()
    { // 子类重写父类的构造器方法
        parent::__construct(); //因为还需调用父类的构造方法 ，保证父类构造器方法执行
        $this->_initSession();
        $this->_checkLogin();
    }
    // 初始化session，验证前初始化
    protected function _initSession(){
      new SessionDB();
    }
    protected function _checkLogin(){
     

      // 列出不需要登录验证的动作列表
      $no_list = array(
        'Admin' => array('login','check','captcha')
      );

      // 当前控制器存在当前动作
      if(isset($no_list[CONTROLLER]) && in_array(ACTION,$no_list[CONTROLLER])){
        // 不需要验证
        return;   //后面不执行
      }
      
      if(!isset($_SESSION['admin'])){
  
        $this->_jump('index.php?p=admin&c=Admin&a=login','请先登录！');
      }
    }

    
  }