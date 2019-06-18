<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller{
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
}