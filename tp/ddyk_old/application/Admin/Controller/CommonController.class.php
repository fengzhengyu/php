<?php
namespace Admin\Controller;
use Think\Controller;

class CommonController extends Controller{

  public function _initialize(){

    $admin_id = session('admin')['admin_id'];
  
    if(!$admin_id){
      $this -> error("您还没有登录!");
    }

  }

}