<?php
namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller {

  public function login(){
    $this->display();
  }
  // 获取验证码
  public function verifyImg(){

    $config = array(
      'imageW'  => 140,
      'imageH'  => 40,
      'fontSize' =>18,
      'fontttf'=> '4.ttf',
      'length' => 4
    );
    $verify = new \Think\Verify(  $config);
    $verify->entry();
  }
  public function LoginAdmin(){
    // 接受信息
    $trans =I();
    // 基本信息判断
    if(empty($trans['username'])){
      $res['code'] = 0;
      $res['message'] = '用户名不能为空';
      $this->ajaxReturn($res);
  
    }
    if(empty($trans['password'])){
      $res['code'] = 0;
      $res['message'] = '密码不能为空';
      $this->ajaxReturn($res);
   
    }
    if(empty($trans['authcode'])){
      $res['code'] = 0;
      $res['message'] = '验证码不能为空';
      $this->ajaxReturn($res);
    }

    $verify = new \Think\Verify();
    // 验证码判断
    if($verify->check($trans['authcode'],'')){
      $data['admin_name'] = $trans['username'];
      $data['admin_pass'] = $trans['password'];

      if($result = M('admin')->where($data)->find()){
        session('admin', $result);
        $res['code'] = 200;
        $res['message'] = '登陆成功';
        $res['data'] = $result;
        $this->ajaxReturn($res);

      }else{
        $res['code'] = 0;
        $res['message'] = '账号或密码错误！';
        $this->ajaxReturn($res);
      }


    }else{
      $res['code'] = 0;
      $res['message'] = '验证码错误';
      $this->ajaxReturn($res);
    }

  }

  // 退出登录
  public function logout(){
    session('admin', null);
    $this->success('安全退出！',U('Login/login'),3);
  }
  
}