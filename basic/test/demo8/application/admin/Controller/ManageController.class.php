<?php

  // 管理员相关功能

  class ManageController extends Controller {

    // 首页
    public function  indexAction(){
      // 没有登录信息
      new SessionDB();
      if(!isset($_SESSION['is_login'])){
  
        $this->_jump('index.php?p=admin&c=Admin&a=login','请先登录！');
      }
      // echo '首台首页';
      require CURRENT_VIEW_PATH . 'index.html';
    }

    // 顶部 
    public function  topAction(){
      require CURRENT_VIEW_PATH . 'top.html';
    }
  }