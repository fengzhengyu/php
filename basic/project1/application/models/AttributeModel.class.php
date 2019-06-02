<?php
// 商品属性模型
class AttributeModel extends Model {
    // 获得所有属性 

    public function getAttributies($type_id){
        // $sql = "SELECT * FROM {$this->table} WHERE type_id = $type_id";
        // 连表查询 会出现两个相同的字段  type_id  不用select * 

        $sql ="select a.* ,b.type_name from p1_attribute as a inner join 
         p1_goods_type as b on a.type_id = b.type_id 
         where a.type_id = $type_id";
        return $this->db->getAll($sql);
    }
    // 分页获取所有数据
    public function getPageAttrs($type_id,$offset,$pagesize){
        $sql ="select a.* ,b.type_name from p1_attribute as a inner join 
        p1_goods_type as b on a.type_id = b.type_id 
        where a.type_id = $type_id limit $offset,$pagesize";
       return $this->db->getAll($sql);
    }

}