<?php
  // 基础控制器类

  class  Controller {
    // 初始化 content-type 功能
    protected function  _initContenType(){
      header('Content-Type: text/html; charset=utf-8;');
    }

    /*
     * @param $url  目标url
     * @param $info  提示信息
     * @param $wait  等待时间（单位秒）
     * @return viod  表示没有返回
    */ 
    protected function  _jump($url,$info=NULL,$wait=3){

        if(is_null($info)){
          // 立即跳转
          header('Location:' . $url);
        }else{
          // 延时跳转
          header("Refresh:$wait;url=$url ");
          echo $info;
         
        }
        // 终止脚本
        die;

    }
    

    // 实例化对象的时候调用，会自动调用构造方法
    public function __construct()
    {
      $this->_initContenType();
    }
  }