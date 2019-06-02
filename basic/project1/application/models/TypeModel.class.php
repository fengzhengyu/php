<?php
// 商品类型模型
class TypeModel extends Model {

    // 获取类型列表
    public function getTypes(){
       
        $sql= "SELECT * FROM {$this->table} ORDER BY type_id";
        return$this->db->getAll($sql);
    }

    public function getPageTypes($offset,$pageSize){
    
        $sql= "SELECT * FROM {$this->table} ORDER BY type_id LIMIT $offset , $pageSize";
        return$this->db->getAll($sql);
    }
}