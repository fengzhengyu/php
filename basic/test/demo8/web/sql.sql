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
  rele_id int unsigned not null default 0 comment '权限角色id rbac',
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