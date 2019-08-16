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
        <div class="side-nav-item ">
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
          <div class="side-nav-item ">
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

      <a href="<?php echo U('User/index');?>" class="link">用户管理</a>
      <?php if($info): ?><a href="javascript:;" class="link"><cite>编辑用户</cite></a>
        <?php else: ?>
        <a href="<?php echo U('User/add');?>" class="link"><cite>添加用户</cite></a><?php endif; ?>
    </span>
  </div>
  <!--内容  -->
  <!-- 添加内容 -->

  <div class="add-module-form">
    <form class="layui-form wrapper" method="POST" enctype="multipart/form-data">

      <?php if($info): ?><div class="layui-form-item">
          <label class="layui-form-label">用户ID</label>
          <div class="layui-input-block">
            <input type="text" name="user_id" required lay-verify="required" autocomplete="off"
              value="<?php echo ($info['user_id']); ?>" readonly class="layui-input">
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">用户名</label>
          <div class="layui-input-block">
            <input type="text" name="user_name" required lay-verify="required" autocomplete="off"
              value="<?php echo ($info['user_name']); ?>" class="layui-input">
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">密码</label>
          <div class="layui-input-block">
            <input type="text" name="user_pass" required lay-verify="required" autocomplete="off"
              value="<?php echo ($info['user_pass']); ?>" class="layui-input">
          </div>
        </div>

        <?php else: ?>
        <div class="layui-form-item">
          <label class="layui-form-label">用户名</label>
          <div class="layui-input-block">
            <input type="text" name="user_name" required lay-verify="required" autocomplete="off" class="layui-input">
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">密码</label>
          <div class="layui-input-block">
            <input type="text" name="user_pass" required lay-verify="required" autocomplete="off" class="layui-input">
          </div>
        </div><?php endif; ?>



      <div class="layui-form-item">
        <div class="layui-input-block">
          <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo" id="submit">提交</button>
          <button type="reset" class="layui-btn layui-btn-primary">重置</button>

        </div>
      </div>
    </form>


  </div>
  <script>
    //Demo
    layui.use(['form', 'upload', 'layer'], function () {
      var form = layui.form,
        $ = layui.jquery,
        upload = layui.upload;
      var layer = layui.layer;
      //监听提交
      form.on('submit(formDemo)', function (data) {
        if (data) {
          console.log(data)
          var temp = data.field;
          var user_name = temp.user_name;
          var user_pass = temp.user_pass;
          var user_id = temp.user_id ? temp.user_id : '';

          $.ajax({
            type: "post",
            url: "<?php echo U('User/confirmSet');?>",
            data: {
              user_id: user_id,
              user_name: user_name,
              user_pass: user_pass

            },
            dataType: "json",
            success: function (res) {

              console.log(res)
              layer.msg(res.msg);
              if (res.code == 200) {
                location.href = "<?php echo U('User/index');?>";
              }
            }
          });

        }
        console.log(data)
        return false;



      });





    });
  </script>


  </div>

</body>

</html>