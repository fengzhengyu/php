<?php

  // 后台管理员相关操作（登录，退出，找密码，管理员增删改查，权限控制等等） 控制器类
  class AdminController extends Controller {


    // 登录表单
    public function loginAction(){
      require CURRENT_VIEW_PATH . 'login.html';
    }
    public function checkAction(){
      // 获取表单数据
      $admin_name = $_POST['username'];
      $admin_pass = $_POST['password'];
     

      // 从数据库中验证管理员信息是否存在合法
      $m_admin = Factory::M('AdminModel');
      if($m_admin->check($admin_name,$admin_pass)){

        // 设置登录标志
       new SessionDB();
       
        $_SESSION['is_login'] = 'yes';
        
        $this->_jump('index.php?p=admin&c=Manage&a=index');
      }else{
        
        $this->_jump('index.php?p=admin&c=Admin&a=login','管理员信息非法');
      
      }
      
    
    }
  }