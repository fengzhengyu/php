<?php
namespace Admin\Controller;
use Think\Controller;
class AuthController extends CommonController {
  public function index(){
    $list = M('auth')->select();

  
  
   
    $this->assign('list',$list);
  
    $this->display();
  }
  public function add(){
    
    if(I('auth_id')){
     $auth_info =  M('auth')->where(array('auth_id'=>I('auth_id')))->find();
     $this->assign('info',$auth_info);
    }
    
    $this->display();
  }
  public function confirmSet(){
    $model = M('auth');
    $data= $model->create();
    if(I('auth_id') == false){
      // 添加
      if($data['auth_name'] == ''){
        $res['code'] = 0;
        $res['msg'] = '权限名不能为空';
        $this->ajaxReturn($res);
      }
      if($data['auth_c'] == ''){
        $res['code'] = 0;
        $res['msg'] = '模块名不能为空';
        $this->ajaxReturn($res);
      }
      if($data['auth_a'] == ''){
        $res['code'] = 0;
        $res['msg'] = '方法名不能为空';
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

  
}