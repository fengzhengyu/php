<?php
// 商品类型模型
class TypeModel extends Model {

    // 获取类型列表
    public function getTypes(){
       
        $sql= "SELECT * FROM {$this->table} ORDER BY type_id";
        return$this->db->getAll($sql);
    }
    // // 获取类型分页数据列表
    // public function getPageTypes($offset,$pageSize){
    
    //     $sql= "SELECT * FROM {$this->table} ORDER BY type_id LIMIT $offset , $pageSize";
    //     return$this->db->getAll($sql);
    // }
    // 获取类型分页数据列表 改进版
    public function getPageTypes($offset,$pageSize){
        // 统计类型下的属性的数量  的到数据库中没有字段的 属性数量字段

        $sql= "SELECT a.*,COUNT(b.attr_name) AS num  FROM {$this->table} AS a
         LEFT JOIN p1_attribute AS b 
         ON a.type_id = b.type_id  GROUP BY a.type_id ORDER BY type_id
         LIMIT $offset , $pageSize";
        

        return$this->db->getAll($sql);
    }
    // 获取编辑信息

    public function getEdit($pk){
        return $this->selectByPk($pk);
    }

    


}