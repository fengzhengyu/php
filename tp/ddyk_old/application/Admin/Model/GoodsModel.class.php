<?php
namespace Admin\Model;
use Think\Model;

class GoodsModel extends Model {
  
  // 分类查询
  public function selectType($where,$condition,$limit){
   $data = M('goods_type')->where($where)->order($condition)->limit($limit)->select();
    return $data;
  }
  // 总数、
  public function pages($where,$tableName="goods"){
    $count = M("$tableName")->where($where)->count();
    return $count;
  }
 
  // 增删改查 
  public function insert($arr,$tableName="goods"){
    $id = M($tableName)->add($arr);
    return $id;
  }
  public function undate($where,$arr,$tableName="goods"){
    $bool = M("$tableName")->where($where)->save($arr);
    return $bool;
  }
  public function find($where,$field,$tableName="goods"){
    $bool = M("$tableName")->where($where)->field($field)->find();
    return $bool;
  }


}