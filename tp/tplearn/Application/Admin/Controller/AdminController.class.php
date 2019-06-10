<?php
namespace Admin\Controller;
// use Think\Controller;
class AdminController extends CommonController {
    public function _initialize(){
      parent::_initialize();
    }
    public function  index(){
      $data['time'] = date('Y-m-d H:i:s');

      $this->assign('data',$data);
      $this->display();
    }

    
}