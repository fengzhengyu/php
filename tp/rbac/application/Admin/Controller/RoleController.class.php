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



   
   
   


      
    //   
    //   
    //   if( $model->add($data)){
    //     $res['code'] = 200;
    //     $res['msg'] = '添加成功！';

    //     $this->ajaxReturn($res);
        
    //   }else{
   
    //   }
    // }

  }

  public function setAuth(){

  }
}