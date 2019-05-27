<?php

  // 管理员相关功能

  class ManageController extends PlatformController {

    // 首页
    public function  indexAction(){
        // print_r($_SESSION['admin']);
      // echo '首台首页';
      require CURRENT_VIEW_PATH . 'index.html';
    }

    // 顶部 
    public function  topAction(){
      require CURRENT_VIEW_PATH . 'top.html';
    }
  }