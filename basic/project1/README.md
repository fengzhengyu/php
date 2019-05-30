# 仿ECShop 项目

  # 项目结构
    -- application    应用程序目录
        -- controllers  控制器目录
            -- admin      后台控制器目录
            -- home       前台控制器目录
        -- models       模型目录
            
        -- views        视图目录
            -- admin      后台视图目录
            -- home       前台视图目录
        -- config       配置文件目录
      
        
    -- framework      框架目录
        -- core         核心类目录
        -- database     数据库驱动目录
        -- helpers      辅助函数目录
        -- libraries    库目录 工具类
    -- public         前台静态文件
        -- uploads      上传文件目录

    -- index.php      单一入口
  # 编码规范
    1 一定要有注释
    2 统一的命名规范 
      文件名  主要指类文件，不是类不加class
      类名  使用大驼峰GoodsController 
      方法名 使用小驼峰 listAction 首字母小写
      属性名 使用小驼峰 ，private属性前面加一个下划线'_'（推荐）
      函数名  遵循PHP本身的写法  下划线 或者全小写
    3 严格区分大小写
      Lamp  linux 系统严格区分大小写
    4 注意缩进，代码对齐


  # 定义核心类 

     - 启动类：
        前后台控制器 视图怎么定义？
          需要解析url 携带的参数 p=admin&c=goods&a=list
          此时我们需要使用$_REQUEST
        初始化工作 路径等
          define();
        路由功能
          new controller()
        自动加载  
          __autoload 魔术函数 不是类的方法 
          自定义自动加载方法
     - 定义核心类
        基础控制器：定义所有控制器都需要用的方法     
          1 提示信息跳转
          2 载入 其他模型（工具类和辅助函数）

          meta 可以控制时间，
            message 页面
     - 载入数据库模型
        Model
        Mysql 需要配置文件         结合我们的config 

     - 载入辅助类  
      在基础类控制器中 加载辅助类 函数类