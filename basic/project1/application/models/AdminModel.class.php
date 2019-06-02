<?php

class AdminModel extends Model {
  // 测试
  public function test(){

    $sql = "select * from {$this->table}";

    return $this->db->getAll( $sql );

  }

  //   验证用户名明码 是否合法

  public function checkUser($username,$password){

    $sql = "SELECT * FROM  $this->table  where admin_name='$username' AND admin_pass='$password' LIMIT 1";

    return $this->db->getRow($sql);
  } 
}