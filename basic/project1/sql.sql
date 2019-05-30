-- goods 表（商品）
    create table goods (
        goods_id int primary key,
        goods_name varchar(100),
        goods_cn varchar(30),
        brand_id int comment '品牌ID 关联品牌表',
        market_price decimal(10,2),
        shop_price  decimal(10,2),
        goods_number int,
        goods_desc text,
        is_hot int,
        is_best int,
        is_new int,
        is_onsale int,
        add_time int ,
        cat_id int comment '分类ID 关联分类表',


    );
-- goods_attr 商品属性关联表 (第三张表) 他的对应goods表 attribute表
    create table goods_attr (
        rec_id int primary key ,
        goods_id  int comment '关联商品表的ID',
        attr_id  int comment '关联扩展信息表的ID',
        attr_value varchar(100)
    
    );
-- attribute 表（商品扩展信息）
create table attribute (
    attr_id int primary key ,
    attr_name varchar(10),
    attr_input_type int,
    attr_type int,
    attr_value varchar(10),
    type_id int 
);

-- goods_type 表 对应attribute表 
create table goods_type ( 
        type_id int  , 
        type_name varchar(30),
        

    );
    
-- brand 表（品牌）
-- 品牌表与商品表的联系 是一对多
  create table brand ( 
        brand_id int  , 
        brand_name varchar(30),
        url varchar(200),
        logo varchar(200) comment '品牌ID 对应的品牌表'

    );


-- category 表（类别）    
    create table category ( 
        cat_id int,
        cat_name varchar(10),
        parent_id int ,


    );

