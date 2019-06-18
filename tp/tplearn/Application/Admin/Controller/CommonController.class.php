<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
  public function _initialize(){
    $mg_id = session('admin')['admin_id'];

    // 登录检测
    if(empty($mg_id)){
      $this -> error("您还没有登录",U('Admin/Login/login'),3);
    }

    // 左侧菜单
    // $admin = M('admin')->find($mg_id); //获取管理员表
    // $role = M('role')->find($admin['admin_role_id']); //通关管理员 角色id 获取角色表
    // $auth_ids = $role['role_auth_ids'];
    // if($admin['admin_role_id'] == 0){
    //   // 超级管理员
    //   $role_name =  '超级管理员';
    //   $info1 = M('auth')->where("auth_level=0")->select();
    //   $info2 = M('auth')->where("auth_level=1")->select();
    // }else{
    //   // 权限管理员
    //   $role_name =  $role['role_name'];
    //   $info1 = M('auth')->where("auth_level=0 and auth_id in ($auth_ids )")->select();
    //   $info2 = M('auth')->where("auth_level=1 and auth_id in ($auth_ids )")->select();
  
    
    //   // 处理 按类别分类 类别处理权限数据
    // }
    // $this->assign('role_name',$role_name);
    // $this->assign('info1',$info1);
    // $this->assign('info2',$info2);

    // 禁止翻墙访问
    $controller = strtolower(CONTROLLER_NAME);
    $all_allow_controller_array = array('login','admin');
    if(!in_array( $controller,$all_allow_controller_array)){ //不在允许控制-炎症
      $now_ac =  strtolower(CONTROLLER_NAME.'-'.ACTION_NAME); //为了权限验证
     
      $admin = M('admin')->find($mg_id);
      $admin_role_id =  $admin['admin_role_id'];
    
      $role = M('role')->find( $admin_role_id);
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
