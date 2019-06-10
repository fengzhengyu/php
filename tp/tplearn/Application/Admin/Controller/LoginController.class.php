<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {

  // 登录方法
  public function login(){
  
   
    
    $this->display();
  }
  // 检测登录信息
  public function LoginAdmin(){
   
    if(IS_POST){
      $verify= new \Think\Verify();
      if($verify->check($_POST['authcode'],'')){
        $username = I('username');
        $password = I('password','',mysql_escape_string);  //防注入，第三个参数是过滤方法
        $data['admin_name'] = I('username');
        $data['admin_pass'] = md5(I('password'));
        if( $res = M('admin')->where($data)->find()){
          session('admin', $res);
          $this->redirect('Admin/index','登陆成功');
        }else{
          $this->error('账号或密码错误！');
        }
      

        // 
      }else{
        $this->error('验证码错误！');
      }
      
    }
   
    
  }
  // 验证码
  public function verifyImg(){

    $config= array(
      'imageW'=> 140,
      'imageH'=> 40,
      'fontSize'=> 20,
      'fontttf'=> '4.ttf',
      'length' => 4


    );
    $verify= new \Think\Verify( $config);
    $verify->entry();


  }
  // 退出登录
  public function logout(){
    session('admin',null);
    $this->success('安全退出！','Login/login',3);
  }
}
