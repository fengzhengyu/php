<?php
namespace Admin\Controller;
use Think\Controller;

class RoleController extends Controller {

  public function index(){
    $model =  M('role');
    $list = $model->select();
    $this->assign('list',$list);

    $this->display();
  }
  public function add(){
    // 有参数输出编辑内容
    if(I('role_id')){
      $role_info = M('role')->find(I('role_id'));
      $this->assign('role_info',$role_info);
    }

    $this->display();
  }
  // 确认添加/编辑结果
  public function confirmSet(){
    $model =  M('role');
    
    if(I('role_id') == false){
      // 添加
      $role_name = trim(I('role_name'));
      // 不为空
      if($role_name  == ''){
        $res['code'] = 0;
        $res['msg'] = '角色名不能为空！';
  
        $this->ajaxReturn($res);
      }
      $data['role_name'] = $role_name;
      // 不重复
      if($role_info = $model->where($data)->find()){
        $res['code'] = 0;
        $res['msg'] = '该角色名已存在！';

        $this->ajaxReturn($res);
      }
      $data['created_time'] = time();
      if( $model->add($data)){
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
      $data = $model->create();
      $data['update_time'] = time();
      if( $model->save($data)){
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

  public function setAuth(){
    if(!I('role_id')){
      $this->error('角色id不正确！');
    }
    // 
    $role_info = M('role')->find(I('role_id'));
    if(!$role_info ){
      $this->error('角色不存在！');
    }
    // 获取所有权限
    $auth_list = M('auth')->order('auth_id desc')->select();

    // 获取所有已分配的权限

    $data['role_id'] = I('role_id');
    $role_auth_list = M('roleauth')->where($data)->select();

   
    $auth_ids = $role_auth_list?array_column($role_auth_list,'auth_id'): array();
    // dump( array_column($role_auth_list,'auth_id'));

    $this->assign('info',$role_info);
    $this->assign('list',$auth_list );
    $this->assign('auth_ids',$auth_ids );
    $this->display();

   
  }

  public function roleSetAuth(){
    $data['role_id'] = I('role_id');
    if(!$data['role_id'] ){
      $res['code'] = 0;
      $res['msg'] = '角色不存在！';
      $this->ajaxReturn($res);
    }
    $auth_ids = I('auth_ids');
    if(empty($auth_ids)){
      $res['code'] = 0;
      $res['msg'] = '最少选择一条权限！';
      $this->ajaxReturn($res);
    }

    // 获取所有 已分配给角色的权限
    $role_auth_list = M('roleauth')->where($data)->select();
   
    $assign_auth_ids = $role_auth_list?array_column($role_auth_list,'auth_id'): array();

    /**
     * 找出删除的权限、
     * 假如已有权限集合是A 界面穿过来的集合是B
     * 权限A集合中的某个权限不在集合B中，就应该删除
     * 使用 array_diff() 计算补集
     * */ 
    $delete_auth_ids = array_diff($assign_auth_ids,$auth_ids);


    // dump( $delete_auth_ids);
  

    if($delete_auth_ids){
      // 删除取消勾选的权限
      foreach( $delete_auth_ids as $auth_id){
        $data['auth_id']  = $auth_id;
        M('roleauth')->where($data)->delete();
      
      }
      
    }

    $new_auth_ids = array_diff($auth_ids,$assign_auth_ids);
    // dump( $new_auth_ids);
    // die;
    if( $new_auth_ids){
      foreach( $new_auth_ids as $auth_id){
        $model = M('roleauth');
        $data['auth_id'] = $auth_id;
        $data['created_time'] = time();
        $model->add($data);
      }

      // $res['code'] = 200;
      // $res['msg'] = '添加权限成功';
      // $this->ajaxReturn($res);
    }
    if(empty($new_auth_ids)&& empty($delete_auth_ids)){
      $res['code'] = 0;
      $res['msg'] = '权限没变动';
      $this->ajaxReturn($res);
    }else{
      
      $res['code'] = 200;
      $res['msg'] = '操作成功';
      $this->ajaxReturn($res);
    }
   
  }
}