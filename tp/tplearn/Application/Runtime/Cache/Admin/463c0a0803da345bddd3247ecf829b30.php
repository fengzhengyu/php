<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>后台管理系统</title>
  <link rel="stylesheet" href="/tp/tplearn/Public/layui/css/layui.css">
  <link rel="stylesheet" href="/tp/tplearn/Public/Admin/css/index.css">
  <script src="/tp/tplearn/Public/Admin/js/jquery.min.js"></script>
  <script src="/tp/tplearn/Public/layui/layui.js"></script>
  <script src="/tp/tplearn/Public/Admin/js/common.js"></script>
</head>

<body>
  <div class="admin-header">
    <div class="logo">后台管理系统</div>
    <div class="skin">

    </div>
    <div class="admin">
      <p class="admin-name"> 登录人:<?php echo ($_SESSION['admin']['admin_name']); ?></p>
      <p>|</p>
      <p class="admin-name">登录身份: 超级管理员</p>
      <p>|</p>
      <p><a href="<?php echo U('Login/logout');?>">安全退出</a></p>

    </div>

  </div>
  <div class="admin-side">
    <ul class="side-scroll">
<!-- 
     <?php if(is_array($info1)): $i = 0; $__LIST__ = $info1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="side-nav">
            <div class="side-nav-item">
              <i class="layui-icon">&#xe63c;</i>
                <?php echo ($vo['auth_name']); ?>
              <i class="layui-icon icon-dropdown">&#xe61a;</i>
            </div>
            <dl class="side-nav-child">
              <?php if(is_array($info2)): $i = 0; $__LIST__ = $info2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i; if($vo2['auth_pid'] == $vo['auth_id']): ?><dd class="side-nav-child-wrapper">
                        <a href="/tp/tplearn/index.php/Admin/<?php echo ($vo2['auth_c']); ?>/<?php echo ($vo2['auth_a']); ?>" class="side-nav-child-link">
                          <span class="side-nav-child-icon"></span> <?php echo ($vo2['auth_name']); ?></a>
                      </dd><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </dl>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>  -->
    
      <li class="side-nav">
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
        </li>
     
    </ul>
    
  </div>
  <div class="admin-body">
    
  <!-- 面包屑 -->
  <div class="crumbs-nav">
    <span class="layui-breadcrumb" lay-separator=">" style="height: 100px;">
      <a href="" class="link"> <i class="layui-icon">&#xe68e;</i> 首页</a>

      <a href="<?php echo U('Goods/index');?>" class="link">权限管理</a>
      <a href="<?php echo U('Goods/update');?>" class="link"><cite>添加权限</cite></a>
    </span>
  </div>
  <!--内容  -->
  <!-- 添加内容 -->

  <div class="add-module-form">
    <form class="layui-form wrapper" action="<?php echo U('Authority/confirmAdd');?>" method="POST"
      enctype="multipart/form-data">

      <!-- <div class="layui-form-item">
        <label class="layui-form-label">权限ID</label>
        <div class="layui-input-block">
          <input type="text" name="auth_id"  value="<?php echo ($current_auth['auth_id']); ?>" autocomplete="off" readonly
            class="layui-input">
        </div>
      </div> -->

      <div class="layui-form-item">
        <label class="layui-form-label">权限名称</label>
        <div class="layui-input-block">
          <input type="text" name="auth_name" required lay-verify="required" autocomplete="off"
            class="layui-input">
        </div>
      </div>
      <div class="layui-form-item">
        <div class="layui-form-item">
          <label class="layui-form-label">父级权限</label>
          <div class="layui-input-block">
            <select name="auth_pid" lay-filter="" required lay-verify="required">
             
              <option value="0">默认父级权限</option>
              <?php if(is_array($parent_auth)): $i = 0; $__LIST__ = $parent_auth;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['auth_id']); ?>"><?php echo ($vo['auth_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
              
            </select>
          </div>
        </div>
    

      <div class="layui-form-item">
        <label class="layui-form-label">控制器名</label>
        <div class="layui-input-block">
          <input type="text" name="auth_c"  placeholder="" autocomplete="off"  class="layui-input">
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">方法名</label>
        <div class="layui-input-block">
          <input type="text" name="auth_a" placeholder="" autocomplete="off"  class="layui-input" >
        </div>
      </div>
      
      <div class="layui-form-item">
        <div class="layui-input-block">
          <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo" id="submit">添加</button>
          <button type="reset" class="layui-btn layui-btn-primary">重置</button>
       
        </div>
      </div>
    </form>


  </div>
  <script>
      //Demo
      layui.use(['form', 'upload'], function () {
        var form = layui.form,
          $ = layui.jquery,
          upload = layui.upload;
        //监听提交
        form.on('submit(formDemo)', function (data) {
          if (data) {
            console.log(data)
          }
          console.log(JSON.stringify(data.field))
          // layer.msg(JSON.stringify(data.field));
          // return false;
        });

       
  
  
  
      });
    </script>


  </div>

</body>

</html>