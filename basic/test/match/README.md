

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
  
# 项目中跳转
  直接跳转：
    header('Location: URL地址');
  延迟跳转  
  header('Refresh:秒数;url=地址');
  
  跳转是在控制器里，多次调用，所以需要在控制器基础类 封装；

# 会话技术 

  cookie:
    允许服务器端脚本在浏览器端存储数据的一种技术，（可见cookie是浏览器技术）

    基本操作：
      设置:  （增删改）  函数
        setcookie($key,$value);

      获取： （查）
        获取浏览器请求时携带的 cookie 数据
        使用超全局数组变量，$_COOKIE 完成对cookie 数据的获取
        PHP核心，在初始化阶段，会将所有请求的cookie数据，整理到$_COOKIE变量中，供脚本使用
    有效期
      默认： 临时cookie （浏览器关闭也就没了）
      支持设置有效期：
        setcookie（）的第三个参数可以对有效期进行设置，有效期采用一个时间戳进行表示！
      删除cookie
         setcookie（$key,'',time()-1）的第三个参数 time()-1
      PHP_INT_MAX： 逻辑上表示永久有效的cookie
    有效路径
      默认： 
        cookie 在当前路径及后代路劲有效
      Tip:  路径，不是代码所在文件的本地磁盘路径，而是url请求的路径关系
      Tip: 不同路径，下同名的cookie可以同时存储于浏览器端
      浏览器发出请求时，会先查找当前目录内有效的cookie，再向上查找，将所有有效的cookie都携带到服务器端，服务器$_COOKIE时，会出现重写效果，才出现的保留。

      可以通过setCookie()第四个参数进行修改：
        通常设置为/表示，站点根目录有效，也就是整站有效。

    有效域
      默认：
        cookie 仅仅在当前域名下有效
      可以通过设置，使用cookie的有效域，扩展到某一级域名下的所有子域
        
      setCookie()第五个参数 放个域名 第四个参数为空，
    是否仅安全传输
      https://  加密的http协议
      默认：
        cookie不论浏览器发出是http还是HTTPS都会将有效的cookie携带到服务器
        如果将 第六个参数 设置为 true，表示，激活仅安全连接传输，此时浏览器在向服务器发出请求时，如果请求协议为http,就不会向服务器发送这些设置为仅安全连接传输的cookie数据。

    HTTPonly
      默认：
        浏览器存储的cookie是可以被其他脚本所处理的 
      通过第7个参数，设置为 httponly 特性，表示仅仅在http请求中使用！  true /false
    语法注意：
      cookie 值： 仅仅支持字符串类型，对象需要转换为字符串类型
      cookie 键： 支持键是数组，但取值不是数组类型
      cookie设定的时候，当前代码不能取值输出
      类似于header（） ，setcookie()前也不能有任何输出

  session：
    将会话数据，存储于服务器端，同时使会话数据可以区分浏览器
    为每个会话技术建立独立的会话数据区，每个会话数据区存在唯一标识，同时浏览器端存储该唯一标识，做配对使用！    

    session 原理：
      存储于浏览器的session-id，就是一个普通cookie变量（在session的机制中尤为特殊的含义）

      每个会话，所生成存储于服务器端的session数据区
      默认，一文件的形式，存储于服务器端操作系统的临时文件
    有效期：
      会话周期结束
    有效路径
      整站有效  
    有效域：
      当前域下有效
    是否仅安全连接传输
      默认值： 否
    是否仅为http使用
      没法测   
    以上session 数据的特征，都是由 浏览器cookie中所存储的session-id变量的特征所导致的 
    可见，如果需要更改session数据的属性，则需要更改存储sessionid的cookie 变量PHPSESSID的属性
    php.ini 中存在该属性的配置：
      有效期 ：
        ; Lifetime in seconds of cookie or, if 0, until browser is restarted.
        ; http://php.net/session.cookie-lifetime
        session.cookie_lifetime = 0
      有效路径：  
        ; The path for which the cookie is valid.
        ; http://php.net/session.cookie-path
        session.cookie_path = /
      有效域：
        ; The domain for which the cookie is valid.
        ; http://php.net/session.cookie-domain
        session.cookie_domain =

      仅安全输出   
        ; http://php.net/session.cookie-secure
        ;session.cookie_secure =
      httponly
        ; http://php.net/session.cookie-httponly
        session.cookie_httponly =   
    如果需要对默认属性修改，办法如下：
      A计划：
        更改php.ini 配置文件即可（不建议）
      B计划：
        通过脚本中，使用函数 ini_set()来进行配置的修改，仅在，设置后的脚本周期内有效，要保证在开启session前，设置完毕       
      C计划：(推荐)
        使用特定功能函数： 
          session_set_cookie_params(有效期，有效路径，有效域，是否仅安全传输，是否httponly)  完成配置
    注意： 选项的设置是针对cookie中的 sessionid ，因此是针对所有session数据的 

    Tip: session 属性通常都会保持其默认值，不建议修改      

    session使用语法问题:
      session数据类型可以是所有类型  
      $_session数组元素的下标，只能是字符串
      session_start() 类似于header（） 函数，前面不能有输出

    session 数据区
      在脚本周期结束后，持久存储当前会话session数据的区域
      在脚本周期内，使用$_SEESION这个变量管理的会话session数据
    session销毁
      函数：
      session_destory(); 删除当前session 对应的数据区，关闭session机制
      注意： $_SESSION变量，在销毁之后，是不会自动消，但是结束不完成写操作，本周期，就不能获取到存储的数据了
    如何完整的删除与当前session相关的全部数据？
      session.destroy()   数据区
      unset($_ESSION)  销毁变量
      setcookie('PHPSESSID','',time()-1) 销毁cookie中的session-id
  重写session 的存储机制
    目的：
      1 便于管理大量的 session 数据
      2 便于web服务器集群共享session 数据
    方案：
      入库 入内存
    实现过程：
      定义（实现）自定义的相关的存储处理函数
      将其设置为session机制存储的 函数（告诉给session机制，使用我们的函数完成存储处理）    

      6个处理函数

      设置session 的存储机制函数：
        session_set_save_handler(开始处理器，结束处理器，读处理器，写处理器，删除处理器，垃圾处理处理器);

    创建 session 表
    对应session 文件
    create table `session`(
      session_id varchar(40) not null default '',
      session_text text,
      last_time int not null default 0,
      primary key(session_id)
    ) charset=utf8 engine=myisam;

    读操作：

    写操作：
      insert into .. ON duplicate key update
      replace 语法与insert一致，存在则替换，不存在则插入
    垃圾回收：
      如何区别垃圾数据区？
        phpsession 机制设置session数据区的最大有效期，某条session记住，在最后一次处理后，如果超过了多久之后没有被使用，则视为垃圾数据
        该时间 默认是1440s 可以被配置 php.ini session.gc_maxlifetime=1440 
        同时需要记录每个session数据区的最后处理时间。
        增加字段 last_time 
          alter table `session` add column last_time int not null default 0;

      如何执行删除？
        在开启session机制的过程中，有概率的执行垃圾回收操作。
        默认的概率为 1/1000

        可以被配置 php.ini
          session.gc_probability =1
          session.gc_devisor = 1000

           1558666779 last<
           1558666906 -1440now
    开始
      session开启是，最早执行的一个存储机制相关方法，用于初始化数据存储的相关操作
    结束
      在session机制关闭时，执行的一个方法，最后一个执行的存储操作的 ，用于收尾工作

    注意：
      先执行 session_set_save_handler()在session_start()  
      保证session 不自动开启
      可以通过配置 .htaccess
        php_flag session.auto_start 0;  不自动开启
      建议重置session 存储机制，应该将其该为user 表示用于自定义
  项目中的session 入库
    以框架基础代码中 扩展工具类的角色，出现在项目中 !     

    增加相应的 目录常量
      采用面向对象的编程思想完成
      工具类：
      要求：
        增加session 入库工具类（完成其自动加载）
        入库操作尤其工具类对象的方法充当
        在实例化该工具类对象时，完成设置session 处理器，并开启session

      使用项目中统一的DAO完成数据库操作

  session 数据持久化    ?
    浏览器端 session-id
      session_set_cookie_params(3600)
    服务器端session数据区
      ini_set('session.gc_maxlifetime','3600')