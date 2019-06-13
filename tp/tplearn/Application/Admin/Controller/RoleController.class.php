<?php
namespace Admin\Controller;
// use Think\Controller;
class RoleController extends CommonController{

  public function index(){
    $list =M('role')->select();
    $this->assign('list',$list);
    $this->display();
  }
  // 分配权限

  public function distribute(){



    
    $role_id = $_GET['role_id'];
    $role = M("role")->find($role_id);
    $role_auth_ids = $role['role_auth_ids'];
    $role_auth_id_array = explode(',',$role_auth_ids);
    // dump( $role_auth_id_array );

    $parentInfo = M('auth')->where("auth_level=0")->select();
    $subInfo = M('auth')->where("auth_level=1")->select();
    $this->assign('role_id',$role_id);
    $this->assign('parentInfo',  $parentInfo );
    $this->assign('subInfo',  $subInfo );
    $this->assign('select_id_array',  $role_auth_id_array );
    // dump($role_auth_id_array);
    $this->display();

  }
  public function dodistribute(){
    if(IS_POST){
      $role_id = $_POST['role_id'];
      $role_auth_ids =implode(',',$_POST['auth']);

      $model =  new \Admin\Model\RoleModel();
      //  成功返回1 失败返回0
     if( $model->updateRole($_POST['auth'], $role_id)){
     
       $this->success('成功','index',2);
     }else{
       $this->error('失败');
     }
     
    }
  }
}