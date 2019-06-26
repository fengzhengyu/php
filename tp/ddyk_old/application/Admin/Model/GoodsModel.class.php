<?php
namespace Admin\Model;
use Think\Model;

class GoodsModel extends Model {
  
  public function insert($data){

    dump($data);
    // $id =  M('goods_type')->add($data);
    return$id;
  }
}