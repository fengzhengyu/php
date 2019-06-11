<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
  public function _initialize(){
    $mg_id = session('admin')['admin_id'];
    if(empty($mg_id)){
      $this -> error("您还没有登录",U('Admin/Login/login'),3);
    }
    // 禁止翻墙访问
    $controller = strtolower(CONTROLLER_NAME);
    $all_allow_controller_array = array('login');
    if(!in_array( $controller,$all_allow_controller_array)){
      $now_ac =  strtolower(CONTROLLER_NAME.'-'.ACTION_NAME); //为了权限验证
      // $admin = M('manager')->find($mg_id);

      
    }

  }
}
