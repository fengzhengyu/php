<?php

class GoodsModel extends Model {
  // 测试
  public function test(){

    $sql = "select * from {$this->table}";

    return $this->db->getAll( $sql );

  }
}