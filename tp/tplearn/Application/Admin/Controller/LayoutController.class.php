<?php
namespace Admin\Controller;
use Think\Controller;
class LayoutController extends Controller {

  // 基础模板
  public function base(){
    echo '<meta charset="utf-8">';

    $mg_id = session('admin')['admin_id'];
    $admin = M('admin')->find($mg_id); //获取管理员表
    $role = M('role')->find($admin['admin_role_id']); //通关管理员 角色id 获取角色表
   
    $auth_ids = $role['role_auth_ids'];
    if($admin['admin_role_id'] == 0){
      // 超级管理员
      $role_name =  '超级管理员';
      $info1 = M('auth')->where("auth_level=0")->select();
      $info2 = M('auth')->where("auth_level=1")->select();
    }else{
      // 权限管理员
      $role_name =  $role['role_name'];
      $info1 = M('auth')->where("auth_level=0 and auth_id in ($auth_ids )")->select();
      $info2 = M('auth')->where("auth_level=1 and auth_id in ($auth_ids )")->select();
  
    
      // 处理 按类别分类 类别处理权限数据
    }
    $this->assign('info1',$info1);
    $this->assign('info2',$info2);

    // dump( $info1);
 
    $this->display();
  }
}