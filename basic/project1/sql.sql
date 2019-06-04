-- goods 表（商品）
    create table p1_goods (
        goods_id int unsigned auto_increment primary key,
        goods_cn varchar(30) not null comment '货号',
        goods_name varchar(100) not null,
        goods_brief varchar(255) not null comment '商品简介',
        goods_desc text comment '商品详情',
        cat_id int not null default '0' comment '分类ID 关联分类表',
        brand_id int not null default '0' comment '品牌ID 关联品牌表',
        market_price decimal(10,2) not null default '0' comment '市场家',
        shop_price  decimal(10,2)  not null default '0' comment '本店价',
        promote_price  decimal(10,2)  not null default '0' comment '促销价',
        promote_start_time  decimal(10,2)  not null default '0' comment '促销开始时间',
        promote_end_time  decimal(10,2)  not null default '0' comment '促销结束时间',
        goods_img  varchar(50)  not null default '' comment '商品图片',
        goods_thumb  varchar(50)  not null default '' comment '商品缩略图',
        goods_number int unsigned not null default '0' comment '商品数量',
        click_count  int unsigned not null default '0'  comment '商品浏览量',
        type_id int  unsigned  not null default '0' comment '商品类型ID',
        is_promote int unsigned not null default '0' comment '是否促销',
        is_hot int unsigned not null default '0' comment '热门的',
        is_best int  unsigned not null default '0' comment '推荐的',
        is_new int  unsigned not null default '0' comment '最新的',
        is_onsale int unsigned not null default '1' comment '上架',
        add_time int unsigned not null default '0' comment '添加时间',
        foreign key(cat_id) references p1_category(cat_id) ,
        foreign key(type_id) references p1_goods_type(type_id) 
        -- foreign key(brand_id) references p1_brand(brand_id) ,
       
    );
-- goods_attr 商品属性关联表 (第三张表) 他的对应goods表 attribute表    这表最后用
    create table p1_goods_attr (
        rec_id int unsigned not null auto_increment primary key ,
        goods_id  int unsigned comment '关联商品表的ID',
        attr_id  int unsigned  comment '关联扩展信息表的ID',
        attr_value varchar(100)
    
    );
-- attribute 表（商品扩展信息）
create table p1_attribute (
    attr_id int unsigned not null  auto_increment primary key ,
    attr_name varchar(50) not null default '',
    type_id int not null ,
    attr_type int not null default '1',
    attr_input_type int not null default '1',
    attr_value text ,
    sort_order int not null default '50',
    foreign key(type_id) references p1_goods_type(type_id) 
    
);
-- 设置外键 foreign key(type_id) references p1_goods_type(type_id) 
-- goods_type 表 对应attribute表 
create table p1_goods_type ( 
        type_id int  primary key auto_increment, 
        type_name varchar(30) not null 
    );
    
-- brand 表（品牌）
-- 品牌表与商品表的联系 是一对多
  create table p1_brand ( 
        brand_id int unsigned not null auto_increment primary key,
        brand_name varchar(30) not null default ''  comment '品牌名称',
        brand_url varchar(200) not null default '' comment '品牌网址',
        brand_logo varchar(200) not null default '' comment '品牌logo',
        brand_desc text comment '品牌详情',
        is_show int unsigned not null default '1' comment '是否显示',
        brand_order int unsigned not null default '50' comment '排序依据'
    );


-- category 表（类别）    
    create table p1_category ( 
        cat_id int unsigned not null auto_increment,
        cat_name varchar(30) not null,
        parent_id int unsigned not null default '0' comment '自关联 实现无限极',
        cat_desc varchar(255) not null default '',
        cat_order int unsigned not null default '50' comment '排序依据',
        unit varchar(15) not null default '' comment '分类的单位',
        is_show int unsigned not null default '1' comment '是否显示',
        filter varchar(100 ) not null comment '暂时没用',
        primary key(cat_id)
    ) charset=utf8;



-- 管理员表
create table p1_admin(
    admin_id int unsigned not null auto_increment primary key,
    admin_name varchar(32) not null  default '',
    admin_pass varchar(32) not null default '' ,
    email varchar(100) not null  default '',
    add_time int not null default '0' 
)charset=utf8;
insert into p1_admin values 
  (null,'admin',md5('admin'),'admin@163.com',0),
  (null,'test', 'test','test@qq.com',0),
  (null,'fengzheng',md5('123456'),'fengzheng1778@163.com',now());
