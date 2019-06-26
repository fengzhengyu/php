<?php

namespace Admin\Model;

use Think\Model;

class AdminModel extends Model
{

  // 得到所用管理员及对应角色数据
  public function select($limit, $where, $field)
  {
    $model = M('admin');
    $data = $model->field()->where($where)->join("ddold_role ON ddold_role.role_id=ddold_admin.role_id", "left")->limit($limit)->select();
    return $data;
  }
  // // 得到所有角色
  // public function select_role()
  // {
  //   $data = M('role')->select();
  //   return $data;
  // }

  // 得到满足要求的总数量
  public function pages($where)
  {
    $count = M('admin')->where($where)->count();
    return $count;
  }
  // 添加一个信息
  public function insert($arr)
  {
    $id = M('admin')->add($arr);
    return $id;
  }
  // 得到一个管理员的信息
  public function find($where)
  {
    $info = M('admin')->where($where)->find();
    return $info;
  }
   //更新一个信息
  public function update($where, $arr)
  {
    $bool = M('admin')->where($where)->save($arr);
    return $bool;
  }
   // 删除一个信息
  public function delete($where)
  {
    $bool = M('admin')->where($where)->delete();
    return $bool;
  }
   // 加密

  public function encrypt($key, $plain_text)
  {

    $plain_text = trim($plain_text);

    $iv = substr(md5($key), 0, mcrypt_get_iv_size(MCRYPT_CAST_256, MCRYPT_MODE_CFB));

    $c_t = mcrypt_cfb(MCRYPT_CAST_256, $key, $plain_text, MCRYPT_ENCRYPT, $iv);

    return trim(chop(base64_encode($c_t)));

  }
//解密
  public function decrypt($key, $c_t)
  {

    $c_t = trim(chop(base64_decode($c_t)));

    $iv = substr(md5($key), 0, mcrypt_get_iv_size(MCRYPT_CAST_256, MCRYPT_MODE_CFB));

    $p_t = mcrypt_cfb(MCRYPT_CAST_256, $key, $c_t, MCRYPT_DECRYPT, $iv);

    return trim(chop($p_t));

  }
  // 连表查询权限信息
  public function sel($id,$model,$action){

  }
}