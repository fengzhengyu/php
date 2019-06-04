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

  # 数据库设计
    - 表与表的联系
    - 每一个字段的类型
    数据库设计的好坏 决定了整个项目的成败
    数据库的设计 体现了你对业务逻辑的理解

    从商品出发
      图片保存分两部分：1是将图片本身保存到磁盘的某个位置， 2是将磁盘地址存入数据库

    表与表的联系分为三种：
      一对一
      一对多
      多对多
    品牌表与商品表的联系
      一个品牌对应多个商品
      一个商品对应一个品牌  
      结论： 一对多的关系，则在多的一方 增加一个字段和一的一方的主键关联
      PK： primary key 主键
      FK： foreign key 外键
      此时，品牌表与商品表之间存在父子关系，品牌是父，商品是子
    商品规格参数如何保存？（难点）
      任何一个商品的信息都是由两部分组成的 
        基础信息：所有商品都具备的信息
        扩展信息：不同类型的商品，他的属性是不一样的  。规格参数
      对基础信息，直接保存到商品类中
      对扩展信息，怎么保存？
        最傻的方式 用一个大字段一次性保存，比如 用text 。但是这样不好，不利于搜索，也不利于管理（页面也不利于展示）
        我们希望的方式，每个商品的每一个规格都用一条记录来保存
        意味着 商品与扩展信息 有一种联系
          一个商品 对应 多条扩展信息
          一条扩展信息 对应  多个商品
          结论： 商品与扩展信息 是一个多对多的关系
          如何保存着类型信息呢？
            多多的关系，需要引入第三张表（关联表），来表示二者的关系

            关联表的主键有两种方式:
              组合主键，使用两个字段构成主键
              再加一个字段，设置为主键

      又面临一个问题？
        有这么多扩展属性，如何来管理
        假如现在有20个商品（书籍、服装、手机等），每种商品有20个扩展属性，那就意味着有400条记录需要管理。

        在这种情况下，我现在需要添加一个 书籍 商品---php编程艺术 ，填写20个扩展属性  。
        需要对扩展属性进行分门类别的管理
        再增加一张表，商品类型表，用来表示商品扩展属性的类别
    -------------
    商品分类添加
      无限级分类：
        从两个方面来说：
          数据表的设计： parent_id 关联   
          程序的实现 : 递归 tree结构
    商品分类编辑：
      先列出商品分类信息，便于修改
      提交表单，完成更新操作


  # 项目安全问题
    常见问题
      1 恶意攻击 暴力破解
      2 SQL 注入
      3 xss 攻击

     恶意攻击 暴力破解：
      get 方式恶意攻击  （dos），通常硬件方面 来防止 防火墙
      post 方式暴力破解  ，从程序的角度防止,最常用的就是增加 验证码
      这里有一个验证码类 captcha 

     SQL 注入：
      黑客通过在表单中或者URL中填入特殊的字符，然后向数据如发起请求，拼凑出sql语句，达到攻击目的
      两个形式：
        表单中填入特殊的字符
        URL 携带填入特殊的字符
        解决 ： addslashes() 对用户名密码转义 url的取值进行转换类型
        结论： 凡是用户提交的信息，都是態不能相信的 ，都要进行处理，其中之一就是转义

     Xss攻击：
      跨站脚本攻击
      XSS是一种经常出现在web应用中的计算机安全漏洞，它允许恶意web用户将代码植入到提供给其它用户使用的页面中。比如这些代码包括HTML代码和客户端脚本。
      如何防止？

        本质是通过标签（一对尖括号）来达到攻击目的，所以我们需要对尖括号进行 转义 ，这就是php中提到的实体转义
        htmlspecialchars()和 htmlentities()
        htmlspecialchars_decode（）将实体转成HTML代码,函数1的反函数 有时候展示不出应有的效果，而是显示出h5代码。多半是需要使用这个函数的  
  # 出现的错误类型
    notice ： 注意
    warning : 提醒 小小 警告
    fatal error : 致命的错误

    如何避免错误？
      良好的编码规范 严格区分大小写
      善于总结 避免同样的错误
    如何排错？
      常用 var_dump() 或者 die(exit)

  # 商品类型
    只需要维护一个字段  type_name

  # 分页分两部分
    
    查询数据获取记录
    使用分页类输出分页信息

  # 商品属性表   
    create table p1_attribute (
    attr_id int unsigned not null  auto_increment primary key ,
    attr_name varchar(50) not null default '',
    type_id int not null ,
    attr_type int not null default '1',
    attr_input_type int not null default '1',
    attr_value text ,
    sort_order int not null default '50',
    foreign key(type_id) references p1_goods_type(type_id) 
    );

    重点字段说明：
    type_id: 商品类型id ,表示该属性是哪个类型
    attr_type: 保存属性的是否可选 唯一属性 单选属性 复选属性
    attr_input_type: 保存属性值的录入的方式
    attr_value:   保存属性的可选值，该值 不一定有 ， 手动输入的  和多行文本框 为空

    属性值的录入方式
      手动输入的        ---文本框
      下拉列表 选择的     ---下拉列表   如果是这个 必须提供可选择的值，如果该值为空，就没有意义了 
      多行文本框        ---文本域
    唯一属性 -- 不能选的  
    单选属性 -- 例如买手机 选择颜色 只能选一个 
    复选属性 --  前台买手机 可以多选的属性
    attr_type和 attr_input_type有什么区别？
    attr_type 是为普通用户服务的  消费者前台点击选择
    attr_input_type 是为管理员 录入商品时使用的 
# 显示商品属性
  分三步走：
  A 显示所有属性
  B 分页显示
  C 按商品类型显示
  
  获得商品属性的数量：
    对应两个表：
      p1_goods_type表  
      p1_attribute 表 中 type_id 关联goods_type表   type_id   多对一
      sql语句
        select a.* ,b.attr_name,b.type_id from p1_goods_type as a inner join p1_attribute as b on a.type_id = b.type_id;
        注意：inner join 如果a.type_id 在b表没有对应的 则不显示 ，用到此时的项目是不合理的，所有用 left join 
      分组统计：
         select a.* ,b.attr_name,b.type_id from p1_goods_type as a left join p1_attribute as b on a.type_id = b.type_id group by a.type_id;  
      统计数量：
         select a.* ,b.attr_name,b.type_id,count(*) from p1_goods_type as a left join p1_attribute as b on a.type_id = b.type_id group by a.type_id;  
         注意： count(*) 如果 值为null  也表示数量一 （只要有一条记录就是统计）； count(字段名) 字段有值为null 则不会统计
      正确：
        select a.*,count(b.attr_name) from p1_goods_type as a left join p1_attribute as b on a.type_id = b.type_id group by a.type_id;  

# 商品管理
  业务逻辑
    从两个方面来看
    商品不是独立的，和其他几个模块有联系
    看表结构
  如何实现局部刷新？
    ajax  
    iframe
  GoodsAttrModel 没必要，因为它是关联表 插入借用 基础Model就行  

暂时