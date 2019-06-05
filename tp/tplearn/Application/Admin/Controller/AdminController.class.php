<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller {
  
    public function  index(){
      $data['time'] = date('Y-m-d H:i:s');

      $this->assign('data',$data);
      $this->display();
    }
}