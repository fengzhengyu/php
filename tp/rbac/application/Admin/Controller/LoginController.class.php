<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends CommonController{

  public function login(){
    $this->display();
  }
  // 登录检测
  public function loginAdmin(){
    if(IS_POST){
      $verify =  new \Think\Verify();
      if($verify->check($_POST['authcode'],'')){
        $data['user_name']= I('username');
      
        if($result = M('user')->where($data)->find()){

            // $data['user_pass']=md5(I('password'));
            $data['user_pass']=I('password');
          
            if($res = M('user')->where($data)->find()){
              session('admin', $res);
              $this->redirect('Index/index','登陆成功！');
            }else{
              $this->error('密码不正确！');
            }
        
        }else{
          $this->error('用户名不存在！');
        }
      
      }else{
        $this->error('验证码错误！');
      }
    }
  }
  // 验证码
  public function verifyImg(){
    $config = array(
      'imageW'=> 140,
      'imageH'=> 40,
      'fontSize'=> 20,
      'fontttf'=> '4.ttf',
      'length' => 4
    );
    $verify = new \Think\Verify($config);
    $verify->entry();
  }


  // 退出登录
  public function logout(){
    session('admin', null);
    $this->success('安全退出！',U('Login/login'),3);
  }
}