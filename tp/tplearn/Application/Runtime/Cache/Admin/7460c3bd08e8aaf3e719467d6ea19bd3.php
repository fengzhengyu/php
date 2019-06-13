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
      <a href="<?php echo U('Goods/index');?>" class="link">商品管理</a>
      <a href="<?php echo U('Goods/index');?>" class="link"><cite>商品别表</cite></a>
    </span>
  </div>
  <!--内容  -->
  <div class="manage-btn-wrapper">
    <form action="">
      <div class="handle-wrap layui-left">
        <!-- 筛选条件 -->


      </div>
    </form>
    <div class="layui-right">
      <a href="<?php echo U('Goods/add');?>" class="layui-btn layui-btn-sm layui-btn-normal">
        <i class="layui-icon">&#xe654;</i>
        添加商品
      </a>
    </div>

  </div>
  <table class="layui-table">

    <thead>

      <tr>
        <th>序号</th>
        <th>商品名称</th>
        <th>商品价格</th>
        <th width="200">商品图片</th>
        <th>商品详情</th>
        <th>商品库存</th>
        <th>是否上架</th>
        <th>商品推荐</th>
        <th>添加人</th>
        <!-- <th>添加时间</th> -->
        <th align="center">操作</th>

      </tr>
    </thead>
    <tbody>
        <!-- <?php if($list == null): ?><tr>不是数组</tr>
            <?php else: ?>
            <tr>是数组</tr><?php endif; ?> -->

      <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
          <td>
            <?php echo ($i); ?>
          </td>
          <td>
            <?php echo ($vo["goods_name"]); ?>
          </td>
          <td>
            <?php echo ($vo["goods_price"]); ?>
          </td>
          <td>
            <img src="<?php echo ($vo["goods_image"]); ?>" alt="">
          </td>
          <td>
            <?php echo ($vo["goods_desc"]); ?>
          </td>
          <td>
            <?php echo ($vo["goods_number"]); ?>
          </td>
          <td>
              <?php if($vo["goods_status"] == 1): ?>√
              <?php else: ?>
                  ×<?php endif; ?>   
          
          </td>
          <td>
            <?php echo ($vo["goods_recommend"]); ?>
          </td>
          <td>
            <?php echo ($vo["create_admin_id"]); ?>
          </td>

          <td>

            <a href="<?php echo U('Goods/edit',array('goods_id'=>$vo['goods_id']));?>" class="layui-btn layui-btn-primary layui-btn-sm edit">
              <i class="layui-icon">&#xe642;</i>
            </a>
  
            <a href="<?php echo U('Goods/delete',array('goods_id'=>$vo['goods_id']));?>" class="layui-btn layui-btn-primary layui-btn-sm delete" onclick="return confirm('你确定删除吗？')">
              <i class="layui-icon">&#xe640;</i>
            </a>
          </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>




      <tr>
        <td colspan="10" align="center">
          <?php echo ($page); ?>
        </td>
      </tr>
    </tbody>
  </table>

  </div>

</body>

</html>