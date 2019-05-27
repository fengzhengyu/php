<?php

  // 后台管理员相关操作（登录，退出，找密码，管理员增删改查，权限控制等等） 控制器类
  class AdminController extends PlatformController {


    // 登录表单
    public function loginAction(){
      require CURRENT_VIEW_PATH . 'login.html';
    }

    // 检验登录信息
    public function checkAction(){

      // 检测验证码
      $_captcha = new Captcha();
      if(!$_captcha->checkCaptcha($_POST['authcode'])){
        $this->_jump('index.php?p=admin&c=Admin&a=login','验证码错误',2);
      }


      // 获取表单数据
      $admin_name = $_POST['username'];
      $admin_pass = $_POST['password'];
     

      // 从数据库中验证管理员信息是否存在合法
      $m_admin = Factory::M('AdminModel');
      if($admin_info=$m_admin->check($admin_name,$admin_pass)){

        // 设置登录标志
        //  new SessionDB(); //因为继承的平台控制器已经开启session  
        // $_SESSION['is_login'] = 'yes';

        $_SESSION['admin'] = $admin_info;

        $this->_jump('index.php?p=admin&c=Manage&a=index');
      }else{
        
        $this->_jump('index.php?p=admin&c=Admin&a=login','管理员信息非法');
      
      }
    }
    // 验证码输出
    public function captchaAction(){
     
      $_captcha = new Captcha();
      $_captcha->generate();
    }

    public function logoutAction(){
    
      unset($_SESSION['admin']);

      // var_dump($_SESSION);
      $this->_jump('index.php?p=admin&c=Admin&a=login');
    }
  }