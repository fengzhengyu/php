<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {

  // 登录方法
  public function login(){
    
    $this->display();
  }
  public function LoginAdmin(){
    
    // $this->success('登陆成功','/Admin/Admin',3);
    $this->redirect('/Admin/Admin','登陆成功');
    
  }
}
