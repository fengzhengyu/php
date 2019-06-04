<?php
// 品牌模型
class BrandModel extends Model {
  // 获取列表数据
  public function getBrands(){
     $sql = "SELECT * FROM {$this->table}";
    return $this->db->getAll($sql);
  }
  // 获取编辑信息
  public function getEdit($pk){
    return $this->selectByPk($pk);
  }
}