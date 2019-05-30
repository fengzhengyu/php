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
    // 实例化对象的时候调用，会自动调用构造方法
  public function __construct()
  {
    $this->_initContenType();
  }

  // 定义载入辅助函数的方法
  public function helper($helper){
    require LIB_PATH . "$helper.class.php";
  }
  // 定义载入工具类方法
  public function library($lib){
    require LIB_PATH . "$lib.class.php";

  }
}