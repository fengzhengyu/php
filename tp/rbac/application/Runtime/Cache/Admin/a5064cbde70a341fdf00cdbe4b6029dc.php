<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>后台管理系统</title>
  <link rel="stylesheet" href="/tp/rbac/Public/layui/css/layui.css">
  <link rel="stylesheet" href="/tp/rbac/Public/Admin/css/index.css">
  <script src="/tp/rbac/Public/Admin/js/jquery.min.js"></script>
  <script src="/tp/rbac/Public/layui/layui.js"></script>
  <script src="/tp/rbac/Public/Admin/js/common.js"></script>
</head>

<body>
  <div class="admin-header">
    <div class="logo">后台管理系统</div>
    <div class="skin">

    </div>
    <div class="admin">
      <p class="admin-name"> 登录人:<?php echo ($_SESSION['admin']['user_name']); ?>
      </p>
      <p>|</p>
      <p class="admin-name">登录身份: 超级管理员</p>
      <p>|</p>
      <p><a href="<?php echo U('Login/logout');?>">安全退出</a></p>

    </div>

  </div>
  <div class="admin-side">
    <ul class="side-scroll">
      <!-- 

       -->
      <li class="side-nav">
        <div class="side-nav-item active">
          <i class="layui-icon">&#xe735;</i>
          权限页面
          <i class="layui-icon icon-dropdown">&#xe61a;</i>
        </div>
        <dl class="side-nav-child">
          <dd class="side-nav-child-wrapper">
            <a href="<?php echo U('Test/index');?>" class="side-nav-child-link">
              <span class="side-nav-child-icon"></span> 默认页面</a>
          </dd>
          <dd class="side-nav-child-wrapper">
            <a href="<?php echo U('Test/page1');?>" class="side-nav-child-link">
              <span class="side-nav-child-icon"></span> page1</a>
          </dd>
          <dd class="side-nav-child-wrapper">
            <a href="<?php echo U('Test/page2');?>" class="side-nav-child-link">
              <span class="side-nav-child-icon"></span> page2</a>
          </dd>
          <dd class="side-nav-child-wrapper">
            <a href="<?php echo U('Test/page3');?>" class="side-nav-child-link">
              <span class="side-nav-child-icon"></span> page3</a>
          </dd>
          <dd class="side-nav-child-wrapper">
            <a href="<?php echo U('Test/page4');?>" class="side-nav-child-link">
              <span class="side-nav-child-icon"></span> page4</a>
          </dd>
          <dd class="side-nav-child-wrapper">
            <a href="<?php echo U('Test/page5');?>" class="side-nav-child-link">
              <span class="side-nav-child-icon"></span> page5</a>
          </dd>

        </dl>
      </li>
      <?php if($_SESSION['admin']['is_admin']== 1): ?><li class="side-nav">
          <div class="side-nav-item active">
            <i class="layui-icon">&#xe735;</i>
            系统设置
            <i class="layui-icon icon-dropdown">&#xe61a;</i>
          </div>
          <dl class="side-nav-child">
            <dd class="side-nav-child-wrapper">
              <a href="<?php echo U('User/index');?>" class="side-nav-child-link">
                <span class="side-nav-child-icon"></span> 用户管理</a>
            </dd>
            <dd class="side-nav-child-wrapper">
              <a href="<?php echo U('Role/index');?>" class="side-nav-child-link">
                <span class="side-nav-child-icon"></span> 角色管理</a>
            </dd>
            <dd class="side-nav-child-wrapper">
              <a href="<?php echo U('Auth/index');?>" class="side-nav-child-link">
                <span class="side-nav-child-icon"></span> 权限管理</a>
            </dd>
  
          </dl>
        </li><?php endif; ?>
     


      <!-- <li class="side-nav">
        <div class="side-nav-item">
          <i class="layui-icon">&#xe735;</i>
          角色管理
          <i class="layui-icon icon-dropdown">&#xe61a;</i>
        </div>
        <dl class="side-nav-child">
          <dd class="side-nav-child-wrapper">
            <a href="<?php echo U('Role/index');?>" class="side-nav-child-link">
              <span class="side-nav-child-icon"></span> 角色列表</a>
          </dd>
          <dd class="side-nav-child-wrapper">
            <a href="<?php echo U('Role/add');?>" class="side-nav-child-link">
              <span class="side-nav-child-icon"></span> 添加角色</a>
          </dd>
  
        </dl>
      </li>
      <li class="side-nav">
          <div class="side-nav-item">
            <i class="layui-icon">&#xe735;</i>
            权限管理
            <i class="layui-icon icon-dropdown">&#xe61a;</i>
          </div>
          <dl class="side-nav-child">
            <dd class="side-nav-child-wrapper">
              <a href="<?php echo U('Authority/index');?>" class="side-nav-child-link">
                <span class="side-nav-child-icon"></span> 权限列表</a>
            </dd>
            <dd class="side-nav-child-wrapper">
              <a href="<?php echo U('Authority/add');?>" class="side-nav-child-link">
                <span class="side-nav-child-icon"></span> 添加权限</a>
            </dd>
    
          </dl>
        </li>
      <li class="side-nav">
          <div class="side-nav-item">
            <i class="layui-icon">&#xe63c;</i>
            商品管理
            <i class="layui-icon icon-dropdown">&#xe61a;</i>
          </div>
          <dl class="side-nav-child">
            <dd class="side-nav-child-wrapper">
              <a href="<?php echo U('Goods/index');?>" class="side-nav-child-link">
                <span class="side-nav-child-icon"></span>商品列表</a>
                
            </dd>
            <dd class="side-nav-child-wrapper">
              <a href="<?php echo U('Goods/add');?>" class="side-nav-child-link">
                <span class="side-nav-child-icon"></span>商品添加</a>
            </dd>
           
          </dl>
        </li> -->

    </ul>

  </div>
  <div class="admin-body">
    

  <!-- 面包屑 -->
  <div class="crumbs-nav">
    <span class="layui-breadcrumb" lay-separator=">" style="height: 100px;">
      <a href="<?php echo U('Index/index');?>" class="link"> <i class="layui-icon">&#xe68e;</i> 首页</a>
      <a href="<?php echo U('Page/index');?>" class="link">page管理</a>
      <a href="<?php echo U('Page/page2');?>" class="link"><cite>page2列表</cite></a>
    </span>
  </div>
  <!--内容  -->
  <div>
    page2 页面
  </div>

  </div>

</body>

</html>