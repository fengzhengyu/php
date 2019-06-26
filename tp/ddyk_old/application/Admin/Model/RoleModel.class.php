<?php
namespace Admin\Model;
use Think\Model;

class RoleModel extends Model{

  // 
  public  function select($limit,$where){
    $data = M('role')->where($where)->limit($limit)->select();
    return $data;
  }
  public  function pages($where){
    $count = M('role')->where($where)->count();
    return $count;
  }
  // 
  public function insert($arr){   
    $id = M("role")->add($arr);
    return $id;
}

public function find($where){
    $model =M("role");
    $info=$model -> where($where)-> find();

    return $info;
}

public function updata($where,$arr){
    $bool = M("role")->where($where)->save($arr);
    return $bool;
}

/**
 * @param $where
 * @return mixed 返回是否删除成功的布尔值
 */
public function delete($where){
    $model = M("role");
    $bool = $model->where($where)->delete();
    return $bool;
}

}