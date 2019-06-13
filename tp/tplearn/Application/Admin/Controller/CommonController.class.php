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
    $all_allow_controller_array = array('login','admin');
    if(!in_array( $controller,$all_allow_controller_array)){ //不在允许控制-炎症
      $now_ac =  strtolower(CONTROLLER_NAME.'-'.ACTION_NAME); //为了权限验证
     
      $admin = M('admin')->find($mg_id);
      $admin_role_id =  $admin['admin_role_id'];
    
      $role = M('role')->find(  $admin_role_id);
      if(!empty($role)){
        // 方法一
        $role_auth_ac =$role ['role_auth_ac'];
        if( stripos($role_auth_ac,$now_ac )=== false){  //stripos 不分大小写  是否包含该字符串 存在返回下标 不存在false
          $this -> error("您无权访问!");
        }
        方法二;
        // $role_auth_ac =   strtolower($role ['role_auth_ac']);
        // $role_auth_ac_array= explode(',', $role_auth_ac);
        // if(!in_array( $now_ac,  $role_auth_ac_array)){
        //   $this -> error("您无权访问!");
        // }
      }
    
    }


  }
}
