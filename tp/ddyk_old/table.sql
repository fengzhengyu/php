-- ddyk_old 数据库

create database ddyk_old;
use ddyk_old;

-- 用户表 
create table ddold_admin(
  admin_id int unsigned not null auto_increment primary key,
  admin_name varchar(32) not null    comment '用户账号',
  admin_pass varchar(32) not null    comment '用户密码',
  status int unsigned not null default '1'   comment '用户状态 1为启用0为禁用',
  role_id int unsigned not null comment '角色id fk',
  name varchar(32)   comment '昵称',
  add_time int unsigned  not null default '0' comment '创建时间-时间戳'

);
-- 角色表
create table ddold_role(
  role_id int unsigned not null auto_increment primary key ,
  role_name varchar(32) not null comment '角色名称',
  add_time int unsigned  not null default '0' comment '创建时间-时间戳'
);
-- 权限表
create table ddold_access(
  access_id  int unsigned not null auto_increment primary key,
  access_name  varchar(32) not null comment '权限名称',
  access_c varchar(32) not null comment '模块名称',
  access_a  varchar(32) not null comment '方法名称',
  add_time int unsigned  not null default '0' comment '创建时间-时间戳'
);
-- 角色权限关系表
create table ddold_role_access(
  id int unsigned not null auto_increment primary key ,
  role_id int unsigned not null comment '角色id fk',
  access_id  int unsigned not null comment '权限id fk',
  add_time int unsigned  not null default '0' comment '创建时间-时间戳'
);


-- 商品分类 
create table ddold_goods_type(
  id int unsigned not null auto_increment primary key ,
  goods_pname varchar(64) not null comment '商品父类名称',
  goods_subname varchar(64) not null comment '商品子类名称',
  goods_pid int unsigned  not null comment '商品父类id',
  is_show  int unsigned not null default '1' comment '显示状态',
  add_time int unsigned  not null default '0' comment '创建时间-时间戳'
);
-- 商品
create table ddold_goods(
  goods_id int unsigned not null auto_increment primary key ,
  member_id int unsigned not null comment '会员id',
  goods_pid int unsigned not null comment '所属父类id',
  goods_sid int unsigned not null comment '所属子类id',
  goods_name varchar(255) not null comment '商品名称',
  goods_image  varchar(255) not null comment '商品图片',
  goods_cover  varchar(255) not null comment '商品封面',
  goods_standard  varchar(255) not null comment '批准文号',
  goods_company  varchar(255) not null comment '生产企业',
  goods_action  varchar(255) not null comment '功能主治',
  goods_size  varchar(255) not null comment '产品规格',
  goods_require  varchar(255) not null comment '招商需求',
  person_name  varchar(255) not null comment '联系人',
  person_phone   varchar(255) not null comment '联系人手机',
  person_qq varchar(255) not null comment '联系人QQ',
  person_tel  varchar(255) not null comment '联系人座机',
  person_address  varchar(255) not null comment '联系人地址',
  jump_url  varchar(255) not null  comment '跳转地址',
  add_time   int unsigned not null  comment '添加时间',
  pass_time   int unsigned not null  comment '通过时间',
  update_time   int unsigned not null  comment '更新时间'
 
);

-- 会员 
create table ddold_member(
  member_id int unsigned not null auto_increment primary key,
  member_token varchar(64) not null comment '用户唯一表示',
  member_name varchar(32) not null comment '会员账号',
  member_pass varchar(32) not null comment '会员密码',
  member_phone varchar(20) not null comment '手机号',
  member_email varchar(32) not null comment '会员密码',
  member_type int unsigned not null default '1' comment '会员级别',
  member_status int unsigned not null default '1' comment '会员状态',
  add_time int unsigned not null default '1' comment '添加时间',
  update_time int unsigned not null default '1' comment '更新时间',
  nickname varchar(32) not null comment '昵称'
);
-- 会员验证码
create table ddold_member_auth(
  id int unsigned not null auto_increment primary key,
  member_account varchar(32) not null comment '会员账号',
  member_authCode int unsigned  not null comment '验证码',
  end_time int  unsigned  not null comment '最后获取时间',
);


