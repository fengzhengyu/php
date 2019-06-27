<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>后台管理系统</title>
  <link rel="stylesheet" href="/tp/ddyk_old/Public/layui/css/layui.css">
  <link rel="stylesheet" href="/tp/ddyk_old/Public/Admin/css/index.css">
  <script src="/tp/ddyk_old/Public/Admin/js/jquery.min.js"></script>
  <script src="/tp/ddyk_old/Public/layui/layui.js"></script>
  <script src="/tp/ddyk_old/Public/Admin/js/common.js"></script>
</head>

<body>
  <div class="admin-header">
    <div class="logo">后台管理系统</div>
    <div class="skin">

    </div>
    <div class="admin">
      <p class="admin-name"> 登录人:<?php echo ($_SESSION['admin']['admin_name']); ?>
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
      <!-- <li class="side-nav">
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
      -->

      <li class="side-nav">
        <div class="side-nav-item">
          <i class="layui-icon">&#xe735;</i>
          权限管理
          <i class="layui-icon icon-dropdown">&#xe61a;</i>
        </div>
        <dl class="side-nav-child">
          <dd class="side-nav-child-wrapper">
            <a href="<?php echo U('Admin/index');?>" class="side-nav-child-link">
              <span class="side-nav-child-icon"></span> 管理员列表</a>
          </dd>
          <dd class="side-nav-child-wrapper">
            <a href="<?php echo U('Role/index');?>" class="side-nav-child-link">
              <span class="side-nav-child-icon"></span> 角色列表</a>
          </dd>
          <dd class="side-nav-child-wrapper">
            <a href="<?php echo U('Authority/add');?>" class="side-nav-child-link">
              <span class="side-nav-child-icon"></span> 添加权限</a>
          </dd>

        </dl>
      </li>
      <li class="side-nav">
        <div class="side-nav-item">
          <i class="layui-icon">&#xe735;</i>
          管理
          <i class="layui-icon icon-dropdown">&#xe61a;</i>
        </div>
        <dl class="side-nav-child">


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
            <a href="<?php echo U('Goods/type');?>" class="side-nav-child-link">
              <span class="side-nav-child-icon"></span>商品分类</a>
          </dd>
          <dd class="side-nav-child-wrapper">
            <a href="<?php echo U('Goods/index');?>" class="side-nav-child-link">
              <span class="side-nav-child-icon"></span>商品列表</a>

          </dd>


        </dl>
      </li>

    </ul>

  </div>
  <div class="admin-body">
    
  <!-- 面包屑 -->
  <div class="crumbs-nav">
    <span class="layui-breadcrumb" lay-separator=">" style="height: 100px;">
      <a href="<?php echo U('Index/index');?>" class="link"> <i class="layui-icon">&#xe68e;</i> 首页</a>

      <a href="<?php echo U('Goods/type');?>" class="link">商品管理</a>
      <?php if($role_info): ?><a href="javascript:;" class="link"><cite>编辑角色</cite></a>
        <?php else: ?>
        <a href="<?php echo U('Goods/addSub');?>" class="link"><cite>添加商品子分类</cite></a><?php endif; ?>
    </span>
  </div>


  <!-- 添加内容 -->

  <div class="add-module-form">
    <form class="layui-form wrapper" action="" method="POST" enctype="multipart/form-data">

      <?php if($type_info): ?><div class="layui-form-item">
          <label class="layui-form-label">分类ID</label>
          <div class="layui-input-block">
            <input type="text" name="type_id" required lay-verify="required" autocomplete="off"
              value="<?php echo ($type_info['id']); ?>" readonly class="layui-input">
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">分类名称</label>
          <div class="layui-input-block">
            <input type="text" name="role_name" required lay-verify="required" autocomplete="off"
              value="<?php echo ($type_info['goods_pname']); ?>" class="layui-input">
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">显示状态</label>
          <div class="layui-input-block">

            <?php if($type_info['is_show'] == 1): ?><input type="checkbox" name="is_show" lay-skin="switch" lay-text="显示|不显示" checked>
              <?php else: ?>
              <input type="checkbox" name="is_show" lay-skin="switch" lay-text="显示|不显示"><?php endif; ?>

          </div>
        </div>
        <?php else: ?>
        <div class="layui-form-item">
          <label class="layui-form-label">父类名称</label>
          <div class="layui-input-block">
            <select name="goods_pid" lay-filter="aihao" required lay-verify="required">
              <?php if(is_array($sub_list)): $i = 0; $__LIST__ = $sub_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>">
                  <?php echo ($vo['goods_pname']); ?>
                </option><?php endforeach; endif; else: echo "" ;endif; ?>

            </select>
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">子类名称</label>
          <div class="layui-input-block">
            <input type="text" name="goods_subname" required lay-verify="required" autocomplete="off"
              class="layui-input">
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">显示状态</label>
          <div class="layui-input-block">

            <input type="checkbox" name="is_show" lay-skin="switch" lay-text="显示|不显示" checked>
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

          var temp = data.field;
          // console.log(temp);

          // return false;
          var goods_pid = temp.goods_pid;
          var goods_subname = temp.goods_subname;
          var is_show = temp.is_show ? 1 : 0;
          // var type_id = temp.type_id ? temp.type_id : null;

          $.ajax({
            type: "post",
            url: "<?php echo U('Goods/insertSub');?>",
            data: {

              // 'id': type_id,
              'goods_pid': goods_pid,
              'goods_subname': goods_subname,
              'is_show': is_show
            },
            dataType: "json",
            success: function (res) {

              console.log(res)
              layer.msg(res.info);

              if (res.flag == 'success') {
                location.href = "<?php echo U('Goods/type');?>";
              }
            }
          });
        }


        return false;
      });





    });
  </script>


  </div>

</body>

</html>