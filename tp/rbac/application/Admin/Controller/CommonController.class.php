<?php
namespace Admin\Controller;

use Think\Controller;

class CommonController extends Controller{

  public function _initialize(){
    $user_id = session('admin')['user_id'];
    
  // dump(session('admin')['is_admin']);
  // die;

  

    // 禁止翻墙访问
    $controller = ucfirst(CONTROLLER_NAME);
    $all_allow_controller_array = array('Login','Index');  //允许进入的页面

    // 
    if(!in_array( $controller,$all_allow_controller_array)){
      if(empty($user_id)){
        $this -> error("您还没有登录",U('Admin/Login/login'),2);
      }
      // 获取 用户所有角色 id 
      $role_ids =  M('userrole')->where(array('user_id'=>$user_id))->field('role_id')->select();
      // dump( $role_ids);
    
      if($role_ids){
        // 角色id 存在 获取权限 ids
        $auth_ids = array();
        foreach($role_ids as $role_id){
          $auth_ids[] = M('roleauth')->where( $role_id )->field('auth_id')->select();
        }
       
        // dump( $auth_ids);
        // die;
        // 循环每个角色对应的权限id  是二维数据 
        foreach($auth_ids as $row){

          // 循环角色一得权限id 
          foreach($row as $auth_id){
            // 获取对应权限
            $auth_info = M('auth')->where( $auth_id )->field('auth_c,auth_a')->find();
            
              // 判断当前控制器与方法是否属于该权限，属于放行，不属于拦截
            if(in_array($controller,$auth_info) && in_array(ACTION_NAME,$auth_info)){
              $auth_status = true;
              break;
            }else{
              $auth_status = false;
            }
           
          }

        }
        // 如果是$auth_status = false  说明该控制器的方法 不在权限内 ，拒绝访问
        if(!$auth_status){
         $this -> error("您无权访问!");
        }
      }
      
     
    

    }
  }
}