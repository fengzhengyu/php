-- 创建数据库
create database test;
use test;

-- RBAC 基于角色的访问控制

-- 用户表
create table t_user(
  user_id int unsigned not null auto_increment primary key,
  cluster_id int unsigned not null default '' comment '所属组织id  fk',
  user_name varchar(32) unique not null default '' comment '登录账号',
  user_pass varchar(32) not null default '' comment '登录密码',
  user_pn varchar(32) default ''  comment '用户姓名',
  user_phone varchar(12)  default '' comment '手机号',
  user_email varchar(64)  default ''  comment '邮箱',
  create_time int unsigned not null default '0' comment '创建时间',
  last_time int unsigned not null default '0' comment '上次登录时间',
  login_count int unsigned not null  default '0' comment '登录次数'
);


-- 角色表(2)
create table t_role(
  role_id  int unsigned not null auto_increment primary key,
  role_pid int unsigned not null comment '父级角色ID',
  role_name  varchar(32) not null default '' comment '角色名称',
  role_desc  varchar(200)  default '' comment '角色描述',
  create_time int unsigned not null default '0' comment '创建时间'
);

-- 权限表(3)
create table t_auth(
  auth_id  int unsigned not null auto_increment primary key,
  auth_pid int unsigned not null comment '父权限ID',
  auth_name  varchar(32) not null default '' comment '权限名称',
  auth_desc  varchar(200)  default '' comment '权限描述',
  create_time int unsigned not null default '0' comment '创建时间'
);

-- 组表(4)
create table t_group(
  group_id  int unsigned not null auto_increment primary key,
  group_pid int unsigned not null comment '父组ID',
  group_name  varchar(32) not null default '' comment '组名称',
  group_desc  varchar(200)  default '' comment '组描述',
  create_time int unsigned not null default '0' comment '创建时间'
);

-- 角色权限表（5）
create table t_role_auth(
  ra_id  int unsigned not null auto_increment primary key,
  role_id int unsigned not null comment '角色ID fk',
  auth_id int unsigned not null comment '权限ID fk',
  auth_type int unsigned  not null default '0' comment '权限类型 1可授权 0 可访问'

);

-- 组权限表（6）
create table t_group_auth(
  ga_id  int unsigned not null auto_increment primary key,
  group_id int unsigned not null comment '组ID fk',
  auth_id int unsigned not null comment '权限ID fk',
  auth_type int unsigned  not null default '0' comment '权限类型 1可授权 0 可访问'
);
-- 组角色表（7）
create table t_group_role(
  gr_id  int unsigned not null auto_increment primary key,
  group_id int unsigned not null comment '组ID fk',
  role_id int unsigned not null comment '角色ID fk'
);

-- 用户权限表（8）
create table t_user_auth(
  ua_id  int unsigned not null auto_increment primary key,
  user_id int unsigned not null comment '用户ID fk',
  auth_id int unsigned not null comment '权限ID fk',
  auth_type int unsigned  not null default '0' comment '权限类型 1可授权 0 可访问'

);

-- 用户角色表（9）
create table t_user_role(
  ur_id  int unsigned not null auto_increment primary key,
  user_id int unsigned not null comment '用户ID fk',
  role_id int unsigned not null comment '角色ID fk'

);

-- 用户组表（10）
create table t_user_group(
  ug_id  int unsigned not null auto_increment primary key,
  user_id int unsigned not null comment '用户ID fk',
  group_id int unsigned not null comment '组ID fk'

);
-- 组织表（11）
create table t_cluster(
  cluster_id  int unsigned not null auto_increment primary key,
  cluster_pid int unsigned not null comment '父组织ID',
  cluster_name varchar(32)  not null comment '组织名称',
  cluster_desc varchar(200)  not null comment '组织描述',
  create_time int unsigned not null default '0' comment '创建时间'

);

-- 操作日志表（12）
create table t_log(
  log_id  int unsigned not null auto_increment primary key,
  user_id int unsigned not null comment '操作人ID',
  op_type int unsigned  not null comment '操作类型',
  content varchar(200)  not null comment '操作内容',
  op_time int unsigned not null default '0' comment '操作时间'

);

-- 以上属于 复杂的 





