<?php

class GoodsModel extends Model {
  // 测试
  // public function test(){

  //   $sql = "select * from {$this->table}";

  //   return $this->db->getAll( $sql );

  // }

  // 获取全部商品数据列表
  public function getGoods(){
    $sql = "SELECT * FROM {$this->table}";
    return $this->db->getAll($sql);
  }

  
}