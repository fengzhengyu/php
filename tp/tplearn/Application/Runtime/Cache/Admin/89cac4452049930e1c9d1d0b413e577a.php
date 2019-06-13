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
      <a href="<?php echo U('Admin/index');?>" class="link"> <i class="layui-icon">&#xe68e;</i> 首页</a>
      <a href="<?php echo U('Role/index');?>" class="link">权限管理</a>
      <a href="<?php echo U('Role/index');?>" class="link"><cite>分配权限</cite></a>
    </span>
  </div>
  <!--内容  -->
  <div class="manage-btn-wrapper">
    <form action="<?php echo U('Role/dodistribute');?>" method="post">
      <ul style="padding-left: 50px; ">
          
        <?php if(is_array($parentInfo)): $i = 0; $__LIST__ = $parentInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li >
              <div style="padding-left: 5px;height: 30px;line-height: 30px; font-size: 14px;color: #555;" >
                  <?php if(in_array($vo['auth_id'],$select_id_array)): ?><input type="checkbox" name="auth[]" value="<?php echo ($vo['auth_id']); ?>" checked="checked">
                    <?php else: ?>
                    <input type="checkbox" name="auth[]"  value="<?php echo ($vo['auth_id']); ?>"><?php endif; ?>
                 
                  <?php echo ($vo['auth_name']); ?>
               
              </div>
              <dl style="padding-left: 30px; ">
                <?php if(is_array($subInfo)): $i = 0; $__LIST__ = $subInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i; if($vo2['auth_pid'] == $vo['auth_id']): ?><dd  style="height: 30px;line-height: 30px; color: #777;">
                        <?php if(in_array($vo2['auth_id'],$select_id_array)): ?><input type="checkbox" name="auth[]" value="<?php echo ($vo2['auth_id']); ?>" checked="checked">
                          <?php else: ?>
                          <input type="checkbox" name="auth[]"  value="<?php echo ($vo2['auth_id']); ?>"><?php endif; ?>
                        <?php echo ($vo2['auth_name']); ?>
                      </dd><?php endif; endforeach; endif; else: echo "" ;endif; ?>
              </dl>
          </li><?php endforeach; endif; else: echo "" ;endif; ?> 
      </ul>
      <input type="hidden" name="role_id" value="<?php echo ($role_id); ?>">
      <div style="margin:30px  150px;"><input type="submit" value="提交"></div>
      
    </form>
  </div>


  </div>

</body>

</html>