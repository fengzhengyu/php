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

