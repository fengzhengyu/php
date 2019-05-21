

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