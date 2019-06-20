<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonController{
  public function index(){
    $list = M('user')->select();
    $this->assign('list',$list);
    $this->display();
  }

  public function add(){
    if(I('user_id')){
      $user_info = M('user')->find(I('user_id'));
      $this->assign('info',$user_info);
    }
    dump($user_info);
   
    $this->display();
  }

  public function confirmSet(){
    $model =  M('user');
    $data = $model->create();
    if(I('user_id') == false){
      // 添加
      if($data['user_name'] == ''){
        $res['code'] = 0;
        $res['msg'] = '用户名不能为空';
        $this->ajaxReturn($res);
      }
      $data['created_time'] = time();
      if($model->add($data)){
        $res['code'] = 200;
        $res['msg'] = '添加成功！';
        $this->ajaxReturn($res);
      }else{
        $res['code'] = 0;
        $res['msg'] = '添加失败！';
        $this->ajaxReturn($res);
        
      }

    }else{
      // 编辑
      $data['update_time'] = time();
      if($model->save($data)){
        $res['code'] = 200;
        $res['msg'] = '修改成功！';
        $this->ajaxReturn($res);
      }else{
        $res['code'] = 0;
        $res['msg'] = '修改失败！';
        $this->ajaxReturn($res);
        
      }

    }
  }

  public function setRole(){
    if(!I('user_id')){
      $this->error('用户id不正确！');
    }
    // 获取用户信息
    $user_info = M('user')->find(I('user_id'));
    // 获取所有的角色
    $role_list = M('role')->order('role_id desc')->select();
    // 获取已分配的角色
    $data['user_id'] = I('user_id');
    $user_role_list = M('userrole')->where($data)->select();

    $role_ids =  $user_role_list? array_column($user_role_list ,'role_id'):array();


    $this->assign('info',$user_info);
    $this->assign('list',$role_list);
    $this->assign('role_ids',$role_ids);
    $this->display();
  }

  public function userSetRole(){
    $data['user_id'] = I('user_id');
    if(!$data['user_id']){
      $res['code'] = 0;
      $res['msg'] = '用户不存在！';
      $this->ajaxReturn($res);
    }
    $role_ids = I('role_ids');
    if(empty($role_ids)){
      $res['code'] = 0;
      $res['msg'] = '最少选择一种角色！';
      $this->ajaxReturn($res);
    }
;
    // 获取已分配的角色
    $user_role_list = M('userrole')->where($data)->select();

    $assign_role_ids = $user_role_list? array_column($user_role_list ,'role_id'):array();

    // 需要删除的角色
    $delete_role_ids = array_diff($assign_role_ids,$role_ids);

   
    if($delete_role_ids){
      // 删除取消勾选的权限

      foreach( $delete_role_ids as $role_id){
        $data['role_id']  = $role_id;
        M('userrole')->where($data)->delete();
      
      }
    }

    // 新增的角色
    $new_role_ids = array_diff($role_ids,$assign_role_ids);

    if( $new_role_ids){
      foreach( $new_role_ids as $role_id){
        $model = M('userrole');
        $data['role_id'] = $role_id;
        $data['created_time'] = time();
        
        $model->add($data);
      }
    } 
  
    if(empty($new_role_ids)&& empty($delete_role_ids)){
      $res['code'] = 0;
      $res['msg'] = '角色没变动';
      $this->ajaxReturn($res);
    }else{
      
      $res['code'] = 200;
      $res['msg'] = '操作成功';
      $this->ajaxReturn($res);
    }




  }
}