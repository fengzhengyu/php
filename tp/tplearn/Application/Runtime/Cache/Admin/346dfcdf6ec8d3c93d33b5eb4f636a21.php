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
      <p class="admin-name"> 登录人:张三</p>
      <p>|</p>
      <p class="admin-name">登录身份: 超级管理员</p>
      <p>|</p>
      <p>安全退出</p>

    </div>

  </div>
  <div class="admin-side">
    <ul class="side-scroll">
      <li class="side-nav">
        <div class="side-nav-item">
          <i class="layui-icon">&#xe735;</i>
          账号管理
          <i class="layui-icon icon-dropdown">&#xe61a;</i>
        </div>
        <dl class="side-nav-child">
          <dd class="side-nav-child-wrapper">
            <a href="<?php echo U('Admin/index');?>" class="side-nav-child-link">
              <span class="side-nav-child-icon"></span> 管理账号</a>
          </dd>
          <dd class="side-nav-child-wrapper">
            <a href="<?php echo U('Admin/customer');?>" class="side-nav-child-link">
              <span class="side-nav-child-icon"></span> 客服账号</a>
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

      <a href="<?php echo U('Goods/index');?>" class="link">商品管理</a>
      <a href="<?php echo U('Goods/add');?>" class="link"><cite>添加商品</cite></a>
    </span>
  </div>
  <!--内容  -->
  <!-- 添加内容 -->

  <div class="add-module-form">
    <form class="layui-form wrapper" action="/tp/tplearn/index.php/Admin/Goods/add.html" method="POST"
      enctype="multipart/form-data">



      <div class="layui-form-item">
        <label class="layui-form-label">商品名称</label>
        <div class="layui-input-block">
          <input type="text" name="goods_name" required lay-verify="required" placeholder="请输入商品名称" autocomplete="off"
            class="layui-input">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">商品价格</label>
        <div class="layui-input-block">
          <input type="text" name="goods_price" required lay-verify="required" placeholder="请输入价格" autocomplete="off"
            class="layui-input">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">复选框</label>
        <div class="layui-input-block">
          <input type="checkbox" name="goods_recommend['精品']" title="精品">
          <input type="checkbox" name="goods_recommend['新品']" title="新品" checked>
          <input type="checkbox" name="goods_recommend['热销']" title="热销">
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">库存</label>
        <div class="layui-input-block">
          <input type="text" name="goods_number" required lay-verify="required" placeholder="" autocomplete="off"
            class="layui-input">
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">商品图片</label>
        <div class="layui-input-block">
          <input type="file" name="goods_image" required lay-verify="required" class="layui-input">
        </div>
      </div>
      <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">商品详情</label>
        <div class="layui-input-block">
          <textarea name="goods_desc" placeholder="请输入内容" class="layui-textarea"></textarea>
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">发布状态</label>
        <div class="layui-input-block">

          <input type="checkbox" name="goods_status" lay-skin="switch" lay-text="上架|下架" checked>
        </div>
      </div>
      <div class="layui-form-item">
        <div class="layui-input-block">
          <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo" id="submit">确认添加</button>
          <button type="reset" class="layui-btn layui-btn-primary">重置</button>
          <button type="reset" class="layui-btn layui-btn-primary">返回产品列表</button>
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