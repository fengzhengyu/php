<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController{

  public function index(){
   $data['time'] = date('Y-m-d H:i:s');
   $this->assign('data',$data);
  // dump( session('admin'));

   $this->display();
  }
}