create database demo7 ;

use demo7 ;

-- 管理员表
-- 前缀+ 逻辑表名
create table demo_admin (
  admin_id int unsigned not null auto_increment ,
  -- 认证相关、
  admin_name varchar(32) not null default '' comment '管理员姓名',
  admin_pass char(32) not null default '' comment '管理员密码 md5加密后的密码',
  -- 权限
  admin_role_id int unsigned not null default 0 comment '权限角色id rbac',
  -- 登录相关的 
  last_ip varchar(15) not null default 0 comment '上次登录ip',
  last_time int unsigned  not null default 0 comment '上次登录时间',
  primary key(admin_id)
);      -- engine=myisam;

insert into demo_admin values 
  (23,'admin',md5('123456'),0,0,0),
  (33,'feng', md5('123456'),0,0,0),
  (43,'zheng', md5('123456'),0,0,0);

--  创建 session 表
--     对应session 文件
    create table `demo_session`(
        session_id varchar(40) not null default '',
        session_text text,
        last_time int not null default 0,
        primary key(session_id)
      ) charset=utf8 engine=myisam;


-- 商品表
    create table demo_goods(
      goods_id int unsigned not null auto_increment,
      goods_name varchar(32) not null default '' comment '名称',
      goods_price decimal(10,2) not null default 0  comment '价格',
      -- category_id int unsigned comment '当前商品所属类型的id,典型的多对一的关系，再多的这，建立关联字段',
      -- brand_id int unsigned  comment '当前商品所属品牌的id',

      goods_image varchar(255) not null default '' comment '当前商品图片',
      goods_cover varchar(255) not null default '' comment '当前商品封面图',
      goods_desc text comment '描述',
      goods_number int unsigned not null default 0 comment '库存',
      goods_status int unsigned not null default 0 comment '上架状态 0是false 1 是true',
      goods_recommend set('精品','新品','热销') not null default '' comment '商品推荐属性使用集合存储',
      create_admin_id int unsigned not null  comment '添加商品的管理员',
      primary key ( goods_id)
    ) charset=utf8;

  -- 分类表
  create table demo_category(
    category_id int unsigned not null auto_increment,
    primary key(category_id)
  );
  -- 品牌表
   create table demo_brand(
   brand_id int unsigned not null auto_increment,
    primary key(brand_id)
  );


  -- 权限表
  create table demo_auth (
    auth_id int unsigned not null auto_increment primary key,
    auth_name varchar(10) not null default '' comment '权限名称',
    auth_pid int unsigned not null  default 0 comment 'pid对应的 一级列表是0',
    auth_c varchar(10) not null default ''  comment '控制器名称',
    auth_a varchar(10) not null default ''  comment '控制器下的方法名称',
    auth_path  varchar(10) not null default ''  comment '路径指向 一级列表id-二级列表id ,如1-4 商品管理-商品类表',
    auth_level int unsigned  not null default 0  comment '权限等级'
  );

  -- 商品管理（1）
  --    商品列表（4）  添加商品（5） 品牌管理（6）
  -- 订单管理（2）
  --    订单列表（7） 添加订单（7） 订单打印（9）
  -- 权限管理（3）
  --    管理员列表（10）  角色管理（11） 权限管理（12）
  insert into  demo_auth values 
  (1,'商品管理',0 ,'','', '1',0),
  (2,'订单管理',0 ,'','', '2',0),
  (3,'权限管理',0 ,'','', '3',0),

  (4,'商品列表',1 ,'Goods','index', '1-4',1),
  (5,'添加商品',1 ,'Goods','add', '1-5',1),
  (6,'品牌管理',1 ,'Goods','brand', '1-6',1),

  (7,'订单列表',2 ,'Order','index', '2-7',1),
  (8,'添加订单',2 ,'Order','add', '2-8',1),
  (9,'订单打印',2 ,'Order','print', '2-9',1),
  
  (10,'管理员列表',3 ,'Admin','index', '3-10',1),
  (11,'角色管理',3 ,'Admin','role', '3-11',1),
  (12,'权限管理',3 ,'Admin','authority', '3-12',1);

-- 角色表
-- 角色分析
--  主管 （商品管理1 商品列表4 添加商品5 订单管理2 订单列表7） 1 4 5 2 7
--  经理 （订单管理2 订单列表7 添加订单8  订单打印 9） 2 7 8 9

create table demo_role (
   role_id int unsigned not null auto_increment primary key,
   role_name varchar(20) not null default '' comment '角色名称',
   role_auth_ids  varchar(128) not null  default '' comment '管理的权限id',
   role_auth_ac text  comment '对应的控制器方法名'
);

insert into demo_role values
  (1,'主管','1,4,5,2,7','Goods-index,Goods-add,Order-index'),
  (2,'经理','2,7,8,9','Order-index,Order-add,Order-print');

