<?php
// admin 表操作模型

class AdminModel extends Model {

  // 验证管理员是否合法
  // @param $admin_name
  // @param $admin_pass
  // @return  bool

  public function check($admin_name,$admin_pass){
    // $admin_name= addslashes($admin_name);
    // $admin_pass= addslashes($admin_pass);
    $admin_name_escape=$this->_dao->escapeString($admin_name);
    $admin_pass_escape=$this->_dao->escapeString($admin_pass);
    $sql = "select * from `demo_admin` where admin_name=$admin_name_escape and admin_pass=md5($admin_pass_escape)"; //不加引号了 已经处理为字符了
    // 因为参数是字符串类型 用单引号引起来，不加 报错
    // die($sql);
    $row =  $this->_dao->getRow($sql);
    return (bool) $row;
  }
}