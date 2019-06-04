<?php
// 基础控制器   定义所有控制器都需要用的方法     

class Controller
{

  // 定义跳转方法
  public function jump($url, $message, $wait = 3)
  {

    if ($wait == 0) {
      header("Location:$url");
    } else {
      include CUR_VIEW_PATH . 'message.html';
    }
    die; //强制退出
  }
    // 初始化 content-type 功能
  protected function _initContenType()
  {
    header('Content-Type: text/html; charset=utf-8;');
  }

  // 登录权限控制 
  protected function _checkLogin(){
    //初始化session
    session_start();
    // 列出不需要登录验证的动作列表
    $no_list = array(
      'Admin' => array('login','signin','captcha')
    );
  //    echo CONTROLLER;
  //    echo CONTROLLER;
  // var_dump(isset($no_list[CONTROLLER]));
 
  // die;
    if(isset($no_list[CONTROLLER]) && in_array(ACTION,$no_list[CONTROLLER])){
      // 不需要验证
      return;   //后面不执行
    }
    
    if(!isset($_SESSION['admin'])){

      $this->jump('index.php?p=admin&c=admin&a=login','请先登录！');
      
    }
  }

    // 实例化对象的时候调用，会自动调用构造方法
  public function __construct()
  {
    $this->_initContenType();
    $this->_checkLogin();
  }

  // 定义载入辅助函数的方法
  public function helper($helper){
    require HELPER_PATH . "{$helper}_helper.php";
  }
  // 定义载入工具类方法
  public function library($lib){
    require LIB_PATH . "{$lib}.class.php";

  }
}