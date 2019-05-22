

比赛列表

球队一   比分   球队二   比赛时间
韩国    1:2    澳大利亚   2015-10-25 17:30

如何完成上面的查询？

获得比赛信息
select * from `match`;   
获得球队一 的名字：
  <!-- as 后面是别名 : match 别名是 m, `team`别名是 t1 -->
  <!-- 取 m表中的他_id = t1表中的 t_id 的数据， -->
  <!-- 连接两个表，把取到的数据 放右边 -->
  select * from `match` as m  left join `team` as t1 ON m.t1_id = t1.t_id;

但是 我们不需要 这么多字段：
<!-- 球队一:t1.t_name, 比分1：m.t1_score ，比分2：m.t2_score, 球队二id:m.t2_id,
  比赛时间：m.m_time -->
  select t1.t_name,m.t1_score,m.t2_score,m.t2_id, m.m_time from `match` as m  left join `team` as t1 ON m.t1_id = t1.t_id;  

获得球队二的 名字：
<!-- 思路： 在连接一次team 表  起别名t2 取 t2表中id 与 m表中id相等的数据 -->
<!-- 球队二id:m.t2_id 换成 t2.t_name -->
  select t1.t_name,m.t1_score,m.t2_score,t2.t_name, m.m_time from `match` as m  left join `team` as t1 ON m.t1_id = t1.t_id left join `team` as t2 ON m.t2_id = t2.t_id;  

 由于列名相同，给列名起别名：
 <!-- t1.t_name as t1_name  ;  t2.t_name as t2name, -->
 select t1.t_name as t1_name,m.t1_score,m.t2_score,t2.t_name as t2name, m.m_time from `match` as m  left join `team` as t1 ON m.t1_id = t1.t_id left join `team` as t2 ON m.t2_id = t2.t_id;  

 php代码完成
 
  match_list.php

显示逻辑相分离

  逻辑  match_controller.php
  显示  match_view.html 

  打开一个页面，是请求逻辑文件， 所有，在逻辑文件里 require view文件

模板文件：
  HTML 负责显示部分功能文件，称之为模板文件

  注意： 浏览器不能去请求负责展示模板的文件，
  可见需要将不能被浏览器所访问的文件隐藏起来
  A计划：
    通过web服务器对请求的控制，不允许浏览器所访问，统一放在一个文件夹内;template

    通过apache 的分布式配置文件完：用 .htaccess  Deny from All;

在实际应用中，我们在处理业务逻辑的时候，发现很多数据处理是重复的，所以我们把数据分离出来，在需要的功能中调用    

MVC 项目构架思想

M ： model 模型，项目中数据处理（业务逻辑处理）单元
V ： view 视图  ，项目中结果展示的单元（模板文件）
C ： controller 控制器， 项目中负责某个功能整体流程调度的单元


模型层典型实现

  每张表，对应一个操作模型，当前表中的所有操作   ，都是用模型完成

  【模型类】每个表的操作模型，由某个模型类实例化而来的对象 【语法】
  每个表操作，对应模型对象的一个方法



基础模型类
  显而易见，在模型中，可能会出现复用的代码，这时候就可以定义  基础模型类

  基础模型类应该被其他model类继承 

模型的单例（：
  如果在一个功能（控制器）中，如果使用某个表的多次操作，应该使用该表的一个模型以完成全部功能。

  如何保证模型的单例？
    可以通过一个单例工厂来实现（为什么不用三私一共？是多个类都需要单例效果）

  工厂类：
    直接new，不能实现需要的业务逻辑，需要辅助一段逻辑代码，才能确定如何去实例化对象，此时需要工厂类

  模型对象的单例效果：
    不能再需要模型时直接就实例化，因为不能实现单例效果，需要一段逻辑代码。来判断当前模型类是否已经实例化过，如果实例化过，则直接返回实例化的对象，否则实例化新的对象

  控制器中，为了得到单例对象，则需要通过工厂类的M方法完成   

控制器类的实现
  控制器类:
    依据功能的相关性，将一系列相关的 功能使用一个控制器类来处理，而该控制器的每个方法就对应某个功能
    注意： 控制器是按照功能划分，而不是像model，按照表来划分

  控制器类在哪里实例化调用呢？  
    增加一个可以实例化并调用控制器方法的文件  index.php

  如何做到一个前端控制器，可以调用一个控制类的不同的方法呢？
    动作分发参数a
        要求在请求控制器index.php时，向其穿一个参数a，表示当前所要执行的控制器，如：
          功能： 比赛功能
            index.php?a=list
          功能： 删除功能
            index.php?a=remove
        Tip: 链接地址的形成，应该在HTML中就确定好了，，再存再一个默认动作    

    控制器分发参数c
      同上 :  index.php?c=Match&a=list

  如何语法层面上保证在一次请求周期呢，当前控制器与当前动作不会放生改变？
    变量容易被修改，不能保证。
    应该用常量保存分发参数 ，进行存储当前控制器及当前动作  define()     

  基础控制器类
    增加为 所有控制器提供基础代码控制器类
    Controller
    提出公共的内容 contenttype    
注意：    
index.php?c=controller&a=action  是单入口模式


#目录布局：
  新建一个根目录： demo3

    ● 框架代码与应用程序代码划分
        框架代码：
          各个应用程序间可以通用代码 -> framework
          
        应用程序代码：
          当前项目的业务逻辑实现的代码  -> application 
          ● 平台platform 的划分
            功能的聚合，也成为 模块module  或 者分组 group,每个给功能是由MVC实现的
            application -> admin (后台部分)和 front(前台部分) 和 test (测试平台)


        分别创建两个子目录 framework application 
        
    ● 入口文件：
      index.php 也应该根目录 

      ● 平台platform 
  总结：
    demo3/
      index.php     入口文件也叫前端控制器
      application/  应用程序目录
        front/        前台
        admin/        后台
        test/         测试平台
           Model/         模型
           View/          视图
           Controller/    控制器

      framework/    框架代码目录

        MysqlDB.class.php       数据库操作类 DAO类
        Factory.class.php       工厂类
        Model.class.php         基础模型类
        Controller.class.php    基础控制器类

  demo3 运行不起来 ,看demo4   

  如何运转起来？
    修改 Apache\conf\extra\httpd-vhosts.conf 文件，设置虚拟站点（因为我用的是phpstudy 所以不需要）
  路径报错？
    修改需要载入路径
    如果写相对路径注意: ：
      当前目录不是代码所在文件的目录（php中代码不是运行在文件中，而是内存中）
      当前位置有浏览器所请求的脚本定（浏览器请求的是index.php,所有当前相对目录./就是针对index.php所在目录开始）
    Tip: 函数 getCWD（）可以获得当前的工作目录   


# 分发参数 p  确定当前平台   demo5   
  demo4 只能加载test平台下的控制器的动作
  如果我们想加载任何平台下的任何控制器的动作？
  url： 
    测试平台的比赛列表： index.php?p=test&c=Match&a=list
    前台的用户注册： index.php?p=front&c=User&a=register

 

  分发参数三个 ： p 平台 c 控制器 a 动作

# 自动加载 类   demo6
  控制器类、模型类、框架核心类
  对于所有类，分两部分考虑：
    1 可以确定的类（当自动加载确定时，类文件已经确定了） 如：框架核心类
    2 可以被扩展的类（当自动加载确定时，类文件无法确定） 如：控制器类、模型类

  对已经确定的类，采用最简洁的方式进行自动加载
  对需要扩展的类，通过类名的规律，完成其位置的判断，进而完成自动加载

  在入口中增加自动加载
  将项目中的 所有载入代码删掉

# 目录地址常量   demo7
  项目中会使用 目录常量来管理项目中的地址，通过拼凑，连接形成某个位置
  先确定的根目录
  根据根目录确定目录常量
  


