
# 框架类（框架初始化类）
  - 将原来入口文件中的功能，放在该类中完成，入口变得简单，清凉
  - 将入口文件中的各个类，由框架类的方法，完成：
    为了简单化，使用纯静态类  Framework.class.php
# 配置文件
  - 在application 目录中，增加一个子目录config 用于管理项目中所出现的 配置文件    
  - 配置文件存储数据的格式 二维数组

  - 初始化项目时，载入改配置文件，获得配置信息
    在框架类中，增加载入配置信息：
      在初始化路径常量后调用配置信息

      index.php用到

      Model用到
      sessionDB用到

# sql注入问题      
  如果sql中，存在浏览器端请求的数据（如post get 传递的字段名），用户通过特殊的数据形式，对SQL的行为作出影响，称之为SQL注入

  正常数据：

      select * from demo_admin where admin_name='feng' and admin_pass=md5('123456')

  非正常数据：
    ' or 1#
      select * from demo_admin where admin_name='' or 1#' and admin_pass=md5('s') 
      // or 1 表示true #表示注释
    ' or 1 or '
      select * from demo_admin where admin_name='' or 1 or '' and admin_pass=md5('2') 
      // or 1 表示真 后面就就不考虑了 
  Tip: 不仅仅登录可以被注入，任何用户数据参与执行，都可以注入
  预防：
    业务逻辑上预防  ：前端 通过限定数据格式（比如，用户名仅由 字母数字下划线和特定字符）或者 限定数据类型
    特殊数据转义： 
      函数： php字符串 addslashes()  mysql 提供的转义函数： mysql_real_escape_string(需要转换的字符串，链接)

  项目中 添加防止 SQL注入的代码：
    子MySQLdb。class.php 中添加一个可以完成转义的方法，在模型中，需要时调用    

    为了避免，整数数据可能不被SQL中增加引号 ，强制在转换后的数据使用引号包裹  

  tip：
    php中魔术引号（magic quotes） ,php中自动求情数据（get post ）增加转义的一种防止SQL注入机制  5.4已经没有了

# 平台控制器
    class PlatformController extends Controlle
    后台的控制器都继承 平台控制器： class AdminController extends PlatformController ...

# 表前缀 模型-前缀处理
  真实表名 = 前缀（项目）+逻辑表名（功能）
  前缀通过配置文件配置
  逻辑表名： 模型类自身来确定
    application.config.php  app配置
    模型类中增加属性： _logic_table
    拼凑真实表名
      基础模型中，增加初始化真实表名方法

# 上传文件
  $_POST 只存 字符串，
  加enctype="multipart/form-data"> 
  服务器在接受到的文件类型的表单数据后：
    将文件，存储于上传零时目录
    该文件可以通过php.ini 配置 upload_tmp_dir
    默认服务器操作系统临时目录
    然后
     move_uploaded_file(当前文件,目标目录);
# 项目中使用上传文件
  工具类 UploadImage

# 目录操作
  创建目录        mkdir(目录地址，权限，是否递归创建=false ))  第二个参数以后是可选
  删除目录        rmdir(目录地址)  不支持递归删除 仅仅可以删除空目录
  移动（改名）    rename(旧地址，新地址)
  获取目录内容（文件）
    打开目录  opendir(目录地址) //返回 目录句柄 php程序与目录的联系
    读文件    readdir(目录句柄) // 第一次 . 第二次.. 读不到false，配合循环就能读取全部文件
    关闭目录  closedir(录句柄)  //读完记得关闭