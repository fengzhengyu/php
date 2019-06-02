<?php
    // 管理员控制器

    class AdminController extends Controller {
     

        //载入登录
        public function loginAction(){
            include CUR_VIEW_PATH  . 'login.html';

        }
        
        // 校验用户登录
        public function signinAction(){
            // 1 手机用户名密码
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            // $password = $_POST['password'];  
            $authcode = $_POST['authcode'];
            
            // 载入辅助函数
            $this->helper('input');
            $username = deepslashes($username);
            $password  = deepslashes($password );
            
            // 验证码检测 
            $captcha =  new Captcha();

            if(!$captcha->checkCaptcha($authcode)){
                $this->jump('index.php?p=admin&c=admin&a=login', '验证码有误');
            }

            // 2 调用模型验证 给出 提示
            $adminModel = new AdminModel('admin');

            if($userinfo = $adminModel->checkUser($username,$password)){
                session_start();
                $_SESSION['admin'] = $userinfo;
                $this->jump('index.php?p=admin&c=index&a=index', '',0);
             
            }else{
                $this->jump('index.php?p=admin&c=admin&a=login', '操作有误');
            }

        }

        // 生成验证码
        public function captchaAction(){
            $c = new Captcha();
            $c->generate();
        }
    }