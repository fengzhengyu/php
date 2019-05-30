<?php
// 后台首页 控制器

  class IndexController  extends Controller{
    public function indexAction(){
      // echo 'admin ... index page ';
      // 当前登陆时间
      $current_date = date('Y-m-d H:i:s');

      include CUR_VIEW_PATH . 'index.html'; 
    }

    public function testAction(){
      // 载入辅助函数
      $this->helper('input');
      f1();
      // 实例化
      $m_goods = new GoodsModel('goods'); //传表名 不要前缀
      echo '<pre>';
      var_dump( $m_goods->test());
    }
  }