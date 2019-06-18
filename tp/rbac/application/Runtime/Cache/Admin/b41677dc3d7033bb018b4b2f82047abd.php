<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8">
  <meta name="renderer" content="webkit|ie-comp|ie-stand">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport"
    content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="stylesheet" href="/tp/rbac/Public/layui/css/layui.css">
  <link rel="stylesheet" href="/tp/rbac/Public/Admin/css/index.css">
  <style>
    .header,
    .footer {
      position: absolute;
      left: 0;
      right: 0;
      width: 100%;
      z-index: 99
    }

    .header {
      top: 0;
      height: 60px;
      background: #426374;
      line-height: 60px;
      text-indent: 40px;
      color: #fff;
    }

    .loginWraper {
      position: absolute;
      left: 0;
      top: 0;
      bottom: 0;
      right: 0;
      z-index: 1;
      background: #3283AC url(/tp/rbac/Public/Admin/images/admin-login-bg.jpg) no-repeat center
    }

    .loginBox {
      position: absolute;
      width: 617px;
      height: 330px;
      background: url(/tp/rbac/Public/Admin/images/admin-loginform-bg.png) no-repeat;
      left: 50%;
      top: 50%;
      margin-left: -309px;
      margin-top: -184px;
      padding-top: 58px
    }

    .loginBox .layui-row {
      margin-top: 20px;
    }

    .loginBox .layui-row .form-label .layui-icon {
      font-size: 24px;
      margin-top: 8px;
    }

    .loginBox .input-text {
      /* width: 360px; */
      width: 90%;
      box-sizing: border-box;
      border: solid 1px #ddd;
      font-size: 16px;
      height: 41px;
      padding: 8px;

    }


    .form-horizontal .form-label {
      margin-top: 8px;
      cursor: text;
      text-align: right;
      padding-right: 10px;
    }


    .form-label {
      display: block;
      color: #555;
    }

    .footer {
      height: 46px;
      line-height: 46px;
      bottom: 0;
      text-align: center;
      color: #fff;
      font-size: 12px;
      background-color: #426374
    }
  </style>
  <title>后台登录</title>
</head>

<body>
  <div class="header">
    <h1>后台管理系统</h1>
  </div>
  <div class="loginWraper">
    <div id="loginform" class="loginBox">
      <form class="form form-horizontal" action="<?php echo U('Login/LoginAdmin');?>" method="post">
        <div class="layui-row">
          <label class="form-label layui-col-md3  layui-col-sm3 layui-col-xs3"><i class="layui-icon">&#xe612;</i></label>
          <div class="formControls layui-col-md8  layui-col-sm8 layui-col-xs8">
            <input name="username" type="text" placeholder="账户" class="input-text">
          </div>
        </div>
        <div class="layui-row">
          <label class="form-label layui-col-md3 layui-col-sm3 layui-col-xs3"><i class="layui-icon">&#xe673;</i></label>
          <div class="formControls layui-col-md8 layui-col-sm8 layui-col-xs8">
            <input name="password" type="password" placeholder="密码" class="input-text">
          </div>
        </div>
       
        <div class="layui-row">
            <label class="form-label layui-col-md3 layui-col-sm3 layui-col-xs3"><i class="layui-icon">&#xe679;</i></label>
            <div class="formControls layui-col-md4 layui-col-sm4 layui-col-xs4">
                <input name="authcode" type="text" placeholder="验证码" class="input-text">
             
            </div>
            <div  class="formControls layui-col-md4 layui-col-sm4 layui-col-xs4">
                <img src="<?php echo U('Login/verifyImg');?>" alt="" onclick="this.src='/tp/rbac/index.php/Admin/Login/verifyImg'">
            </div>
          </div>

        <div class="layui-row">
          <!-- layui-col-md8 layui-col-md-offset3   layui-col-xs8 layui-col-sx-offset3  layui-col-sm8 layui-col-sm-offset3""-->
          <div class="formControls layui-col-md-offset3 layui-col-md8  layui-col-sm8  layui-col-sm-offset3 layui-col-xs8 layui-col-xs-offset3 "  >
            <input name="" type="submit" class="layui-btn layui-btn-normal"
              value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
            <input name="" type="reset" class="layui-btn layui-btn-primary"
              value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="footer">Copyright 你的公司名称</div>
</body>

</html>