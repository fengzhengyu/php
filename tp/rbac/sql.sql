-- cbac数据库 

create database demo_rbac;
use demo_rbac;


-- 创建 用户表
create table demo_user(
  user_id  int unsigned not null auto_increment primary key ,
  user_name varchar(32)  not null  unique comment '用户名',
  user_pass varchar(32)  not null   comment '密码',
  is_admin int not null default '0' comment  '是否是管理员',
  user_status int  not null default '1' comment '是否可以登录 1为可以 0 为不可以',
  update_time int not null default '0'  comment '跟新时间 时间戳',
  created_time int not null default '0'  comment '创建时间 时间戳'
  
);
insert into demo_user (user_name,user_pass) values ('admin',md5('123456'));

-- 创建 角色表
create table demo_role(
  role_id  int unsigned not null auto_increment primary key,
  role_name varchar(32)  not null  comment '角色名',
  role_status int  not null default '1' comment '角色状态 1为有效 0 为无效',
  update_time int not null default '0'  comment '跟新时间 时间戳',
  created_time int not null default '0'  comment '创建时间 时间戳'

);

-- 用户角色表  关联两表 fk表示外键
create table demo_userRole(
  id  int unsigned not null auto_increment primary key ,
  user_id int unsigned not null comment '用户id fk',
  role_id int unsigned not null comment '角色id fk',
  created_time int not null default '0'  comment '创建时间 时间戳'
);
-- 创建 权限表
create table demo_auth(
  auth_id int unsigned not null auto_increment primary key ,
  auth_name varchar(32)  not null  comment '权限名',
  auth_c varchar(32)  not null comment '模块名',
  auth_a varchar(32)  not null comment '方法名',
  auth_status int  not null default '1' comment '权限状态 1为有效 0 为无效',
  update_time int not null default '0'  comment '跟新时间 时间戳',
  created_time int not null default '0'  comment '创建时间 时间戳'
);

-- 角色权限表  关联两表 fk表示外键
create table demo_roleAuth(
  id  int unsigned not null auto_increment primary key ,
  role_id int unsigned not null comment '角色id fk',
  auth_id int unsigned not null comment '权限id fk',
  created_time int not null default '0'  comment '创建时间 时间戳'
);