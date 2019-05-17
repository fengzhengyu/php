# 数据库
  -数据库基础
    数据库分类： 网状数据库、层次数据库、关系型数据库
    关系型数据库：
      数据都是以“分门类别”的方式储存在一个一个的表中，每个表理论上只储存某类信息
      表根表之间的数据可以建立一定的对应显示应用需求的关系

    关系型数据库常见术语  ：

    数据库操作的基本模式：（流程）
      1 客户端---建立连接---服务器端
      2 （返回）客户端--》命令--》服务器端 接受、执行--》返回结果 --》接受结果--》处理（显示）
      3 断开连接

  -mysql 系统级操作和基本规定：
    登录退出 基本操作：
      mysql -hlocalhost -uroot -p
    备份恢复数据库：
      备份：mysqldump -h 服务器地址 -u 用户名 -p  数据库名 > 要储存为的文件名(路径)
      备份：mysql -h 服务器地址 -u 用户名 -p  数据库名2 < 要储存为的文件名(同上)

    基本语法规定：
      注释
      语句结束符：默认是“；”，可以用delimiter 修改为其他
    PHP中操作数据库的基本代码和流程
      1 连接数据库： mysql_connect('数据库服务器地址','用户名','密码')  ；
      2 设定连接编码： mysql_set_charset('编码名'); //对应语句： set names 编码名；
      3 选定数据库： mysql_select_db('数据库名');   //对应语句： use 数据库名
      4 执行SQL语句： mysql_query('SQL语句')；
      如果是非返回数据语句: 那么返回值只有true和false
      如果是返回数据语句，失败同样返回false ，但成功会返回数据集（结果集）
      此时就需要进行“便利取出”
        while（$record=mysql_fetch_array(结果集)）{
          //$record 是一个数组，里面装了一行数据，数组的下标就是行的字段名
        }
  -数据定义语句
    数据库定义
      语法形式：
        创建数据库  create database db1 charset utf8; //并设置编码
        选择数据库 use db1;
        创建表名  create table tab1(id int,f1 float, f2 varchar(20), f3 datetime);
          插入数据  insert into tab1(id,f1,f2,f3)values(1,1.1,'abcdefg',now());
          查看所有数据 select * from tab1;
          退出  quit;
          备份数据 mysqldump -uroot -p db1 > c: /dumpdata/db1.txt
          恢复数据 mysql -uroot -p test < c: /dumpdata/db1.txt //把数据恢复到test 数据库



      删除数据库
      其他数据库相关语句

  问题： 在 cmd 使用 set names utf8 然后乱码？
    cmd 必须使用gbk
    php中，可以根据文件的编码来定义    （常用utf8,ANSI编码就是（gbk）） 

  -数据类型（字段类型）
    数值型
      整数类型：
        tinyint(1字节)、smallint(2字节)、mediumint(3字节)、int(4字节)、bigint(8字节)
        1字节 = 8位 （8个灯泡）
          一个灯泡只能表达2个意思（2个数字）
          三个灯泡表达 8个意思
          八个灯泡（一个字节）可以表达256个数字
        通用设定类型：
          定义一个字段的时候类型写法。
          比如： create table tab1 (f1 数组类型);
          数据类型： 类型名[长度n] [unsigned] [zerofill]  
            长度n ：表示显示形式上的长度 如 12 012 0012
            unsigned: 设定为 “无符号” 数，不能是负数，正数几乎加倍
            zerofill: 填充0，是指如果一个数字长度不够指定长度的时候，可以在左边添0补位
            注意： 设定了zerofill。同事包含了  unsigned
      小数类型：
        单精度浮点数： float ,  通用不设定长度，
        双精度浮点数: double， 通用不设定长度，
        定点型:  decimal  这是精确数，通常定点型需要设置长度，形式为 decimal（总长，小数位数）

    字符串型
      最近基本最重要的2个：
       varchar类型：可变长度字符串类型，最多存储65532个字节的字符串。设定字符串长度只是最长长度，但   可以不存满，则实际长度为数据长度

        char类型：定长字符串类型，如果存储不足设定的长度，则会补充空格自动填满。

      2个二进制文本
        binary： 类似 char ，不过存的是二进制
        varbinary： 类似 varchar ,同样也是二进制
      大文本类型
        text: 可以存储 “超大文本”，相对char varchar 效率底  
        blob: 可以存储 “超大二进制文本，通常用于存储图片这种二进制数据
      2个有关“选项”的文本存储类型
        enum: 
          专门用于方便储存表单类型中的“单选项”的值
          enum('选项1'，'选项2'，'选项3'，'选项4  ')
        set: 专门用于方便储存表单类型中的“多选项”的值

    日期时间型
      date,time , datetime, year, timestamp
      注意：
        写入数据库时，直接的日期时间数据，应该用单引号引起来。
        year类型可以是四位纯数字字符串，也可以是两位整数
        timestamp 时间戳 


    其他类型（了解）：
      位类型： bit
      序列类型：serial  
      布尔类型： bool
  - 表定义语句
    创建表
      基本形式：
        create table[if not exists]  表名（字段列表，索引或约束列表）表选项列表
        字段形式： 字段名 类型 [字段属性列表]
      字段属性设置
        primary key 既是字段属性也是约束还是索引
        unique      既是字段属性也是约束还是索引
        auto_increment
        not null        既是字段属性也是约束
        default 默认值   既是字段属性也是约束
        comment 注释
      索引设置
        普通索引： key (字段名1，字段名2,...)
        主键索引： primary key(字段名1，字段名2,...)
        唯一索引： unique key(字段名1，字段名2,...)
        全文索引： fulltext（字段名1，字段名2,..） 对中文不友好
      约束设置
        主键约束，唯一约束，非空约束，默认值约束，外键约束

      表选项
        engine= “存储引擎”，选择在性能和功能上的最佳结合点
        auto_increment = 起始数字
        charset = 字符编码
        comment = 注释

    修改表    
      基本形式：
        alter table 表名 修改语句1，修改语句2，...；
    删除表
      drop table 表名 ；
    其他操作：
      show tables; 
      desc 表名；
      show create table 表名       显示某表的的创建语句
      rename table 表名1 to 表名2；   重命名表名
      create table 表名2 like 表名1；   从已知表复制表结构
      create table 表名2 select * from 表名1 where 1<>1；   从已知表复制表结构  （**这种会丢失数据，推荐上一种）
      create [unique | fulltext] index 索引名 on 表名（字段1，字段2，....）；创建索引 这里省略unique 和fulltext就是普通索引，这里在系统上映射了一条 alert table 的添加索引语句
      drop  index 索引名 on 表名；删除索引 此语句同样被映射为一条 alert table 的删除索引语句
  - 视图
    什么是视图：
      就是一条预先存储的select 语句（并给定一个名字），以后后续 方便查询
    视图的创建形式：
      create view 视图名 [(字段1，字段2..)]  as select 语句；
  - 数据库（表）的设计思想介绍：
    数据库设计3规范（3NF）:
      第一规范（1NF）: 原子性，数据不可再分
      第二规范（2NF）: 唯一性，消除部分依赖
      第三规范（3NF）: 独立性性，消除传递依赖
      遵循一个大原则： 一种数据存入一个表中（不要将多种数据混在一个表中）
# 数据插入   
  3种语法形式：
    形式一： insert into 表名 [字段1，字段2，字段3，...] values (数据1，数据2，数据3，...)，（...），...；
    形式二： insert into 表名 set 字段1 =表达式1，字段2=表达式2， 字段3= 表达式3，...；
    形式三： insert into 表名 [(字段1，字段2，...)] select 字段1，字段2， .... from 其他表

    说明：
      形式一和形式三可以一次性插入多条数据，且形式三的数据来源是由其中 select语句所获取的 
      形式一和形式三的字段部分可以省略（但严重不推荐），此时值列表必须完全对应每一个字段
      不管哪种类型，字段与值必须 “一一对应”关系，数量、顺序、类型都应该对应
      字符串类型和时间类型，如果是字面量，通常需要用单引号引起来，
      语句中所给定的字段顺序，可以不是表中的顺序
      有的字段通常无需插入数据，比如 auto_increment属性字段，或类型为 timestamp的字段
      载入文本数据： load data infile 语句； 要求该记事本的数据“比较整齐”，一行文本对应一行数据
      完整复制一个表（包括表结构，表数据）： create table 新表名 select * from 原表名

# 删除数据
    delete from  表名 [where条件] [order 排序] [limit 限定]；

    解释：
      1 以行为单位
      2 通常 where 条件通常写上，不写就全删了
      3 order 和 limit，通常不要
        order 用于设定删除数据的先后数据
        limit 用于设定的顺序下，删除指定某行
   其他删除语句：
    truncate table 表名； 用于删除整个表（结构）并重新创建该表
     1 删除表 数据结构都没了
     2 重新创建表 全新表
     3 跟 delete 语句 不带where 有什么却别？
      主要影响是auto_increment 这类型字段，truncate 结果重新计算，delete 还能继续增长     
# 修改数据
  基本语法：
    update 表名 set 字段1=值1，字段2=值2，... [where ] [order ] [limit];

    解释：
      1 以行为单位
      2 where 在应用中通常都写
      3 order 和 limit，通常不要
      5 字段值 可以是表达式，直接值，函数。直接值字符串加引号
# 查询数据
  # 基本查询
    语法形式：
      select [all | distinct] 字段表达式列表 [from 子句] [where 子句] [group by 子句]] [having 子句] [order 自己] [limit 子句];
      解释： 
        1 作用是从数据源中取出 一定数据，并作为该语句的返回结果
        2 总会返回数据，直接量 函数 计算等

        【all | distinct】用于设定所select出来的数据是否允许出现重复行（完全相同的数据）
          all :允许
          distinct : 不容许
        from 子句：
          就是指定数据的数据源 ，其实就是表 ，可以是一个表名，也可以是多个表，---多表查询
        where 子句：
          相当于php或js中的  if语句 ，其结果是布尔值
            算数运算符
            比较运算符 >,>= <=<,=,<>这是不等于 
            逻辑运算符  and(与) or（或） not（非） 
            布尔值 空值
            between语法  字段名 between 小值 and 大值；
            in 语法   字段名 bin（值1，值2,...）；
            like 语法  字段名 like ‘字符’  即所谓模糊查找
              要查找的字符中，有两个特殊含义的字符
              1 % ： 表示任意个数的任意字符
              2 _ : 表示一个任意字符 
              实际应用中 通常是 like  '%关键字%'；


          例如：
            where 1; where 1=1 ; 都是true,反之就是false
        group by  分组子句：
          形式:  group by 字段1 排序1，字段2 排序2，...；
          含义： 就是将数据以某个字段值为依据，分到不同的组别里
          注意：
            1 数据结果只能是组， -- 没有数据本身的个体
            2 数据可能会丢失很多特征，比如没有性别身高姓名年龄等
            3 实际上结果只剩 组作为整体的信息，
            依赖的函数：
            count(*)   统计一组中的数量
            min()      该字段在该组的最小值
            max()      该字段在该组的最大值
            sum()      该字段在该组的总和
            avg()      该字段在该组的平均值
        having 子句
          形式： 与where 子句完全一样
                where 是针对字段都值进行条件判断
                having是只针对group by 以后的 “组 ”数据进行条件判断
                  不能使用 ：字段名 >10 但可以使用 count(字段名) >10



    
      orderby 子句
        order by 字段1 排序方式1，字段2 排序方式2，。。。。
        排序方式： asc 默认 desc

      limit 子句
        limit 起始行号 获取出的行数；
        常用用于翻页，原理如下：
          $pageSize =10; //认为设定一次取10行
          $page =1;    //默认为第一页
          if(!empty($_GET['page'])){ //传来的页码存在
            $page = $_GET['page'];
          }
          $start = ($page -1)* $pageSize;
          $sql = "select * from tabl limit  $start $pageSize";
  # 连接查询
    基本含义： 将两个表的所有行数据，进行“两两横向对接”，对接后，形成字段更多的行。
    连接语法的基本形式：
      from tab1（左表）[连接方式] join  tab2 （右表）[on 条件] ； //[]里的表示可以省略
    交叉连接：
      from tab1（左表）[cross] join  tab2 （右表）;
    内连接：
      from tab1（左表）[inner] join  tab2 （右表）on 条件;
    
    左（外）连接： 
      from tab1（左表）left join  tab2 （右表）on 条件;
        内连接加上左边满足不了条件的其他数据
    右（外）连接：
      from tab1（左表）right join  tab2 （右表）on 条件;
        内连接加上右边满足不了条件的其他数据
    全（外）连接： 
      mysql 中不支持该语法，但可以通过以下办法实现 ：
            select * from ftab1 left join  tab2  on 条件
            union
            select * from ftab1 left join  tab2  on 条件

    连接查询举例：

  # 子查询
    什么叫子查询： 一个select 语句中又“内嵌”了select语句
    子查询分类结果： 表子查询、行子查询、列子查询、标量子查询
    使用场合分：
      用于 select 部分的“输出结果”
      用于 from 子句的数据源
      用于 where 子句的判断依据
      自查询作为数据来源（from子句）必须给起一个别名
      
    常见的子查询及相关关键字：
      使用 in 子查询
      使用 any 子查询
      使用 all 子查询
      使用 some 子查询
      使用 exists 子查询
      使用 not exists 子查询
  #联合查询
    基本含义： 将两个输出字段一致的 select查询结果数据以“层叠”合并的方式获得一个更多行的数据结果
    语法形式:
    select 语句1
    union
    sleect 语句2
# mysql 数据控制语言（DCL）
  数据控制 其实就是“分配权限' --- 就涉及到用户
  主要两个问题：
    用户管理：

    权限分配：
      有哪些权限
      




