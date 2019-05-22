<?php
  // 基础控制器类

  class  Controller {
    // 初始化 content-type 功能
    protected function  _initContenType(){
      header('Content-Type: text/html; charset=utf-8;');
    }

    // 实例化对象的时候调用，会自动调用构造方法
    public function __construct()
    {
      $this->_initContenType();
    }
  }