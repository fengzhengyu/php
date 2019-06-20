<?php
namespace Admin\Controller;

use Think\Controller;

class CommonController extends Controller{

  public function _initialize(){
    $user_id = session('admin')['user_id'];
    
    // if(empty($user_id)){
    //   $this -> error("您还没有登录",U('Admin/Login/login'),2);
    // }


  

    // 禁止翻墙访问
    $controller = strtolower(CONTROLLER_NAME);
    $all_allow_controller_array = array('login','admin');

    dump( $controller);
    die;
    if(!in_array( $controller,$all_allow_controller_array)){
      // $now_ac =  strtolower(CONTROLLER_NAME.'-'.ACTION_NAME);

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
        $auth_urls = array();
        foreach($auth_ids as $row){
            
          foreach($row as $auth_id){
            // $auth_urls[] = M('auth')->where( $auth_id )->field('auth_c,auth_a')->select();
        
            $auth_urls = array_merge( $auth_urls,M('auth')->where( $auth_id )->field('auth_c,auth_a')->select());
          }

        }
       
        foreach($auth_urls as $auth){
          
         if( $auth['auth_c'] == $controller &&  $auth['auth_a'] == ACTION_NAME){
          $auth_status = true;
          break;
          // die;
         }else{
          $auth_status = false;
          // $this -> error("您无权访问!");
         }
         if(!$auth_status){
          // $this -> error("您无权访问!");
         }
        }
      }
      
     
    

    }else{

    }
  }
}