<?php

  // 管理员相关功能

  class ManageController extends Controller {

    // 首页
    public function  indexAction(){
      // 没有登录信息
      session_start();
      if(!isset($_SESSION['is_login'])){
  
        $this->_jump('index.php?p=admin&c=Admin&a=login','请先登录！');
      }
      echo '首台首页';
    }
  }