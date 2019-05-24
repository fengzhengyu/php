
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
