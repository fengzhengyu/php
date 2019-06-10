<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
  public function _initialize(){
    $mg_id = session('admin')['admin_id'];
    if(empty($mg_id)){
      $this -> error("您还没有登录",U('Admin/Login/login'),3);
    }

  }
}
