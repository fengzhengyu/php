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
        echo '登录成功 ，跳转后台首页';
      }else{
        
        echo '非法，提示： 跳转登录页';
      
      }
      
    
    }
  }