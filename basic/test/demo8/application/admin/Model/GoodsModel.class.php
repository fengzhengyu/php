<?php

// goods model

class GoodsModel extends Model
{
  protected $_logic_table = 'goods'; //逻辑表名
  /**
   * 插入商品
   * @param  $escape_data array 关联数组字段与值
   * @return  bool
   * */
  public function insertGoods($data)
  {
    // 先做数据校验
    $data['create_admin_id'] = $_SESSION['admin']['admin_id'];
    // 插入到 goods表
    // 格式化字符串 sprintf(格式，格式中需要的数据)
    // $sql = "insert into demo_goods values (null,'{$data['goods_name']}','{$data['goods_price']}','','','{$data['goods_desc']}','{$data['goods_number']}','{$data['goods_status']}','{$data['goods_recommend']}','{$data['create_admin_id']}')";
    
    // $sql = sprintf("insert into demo_goods values (null,'%s','%s','','','%s','%s','%s','%s','%s')",$data['goods_name'],$data['goods_price'],$data['goods_desc'],$data['goods_number'],$data['goods_status'],$data['goods_recommend'],$data['create_admin_id']);


    // return $this->_dao->query($sql);

    // 防止注入 在模型层面提供可以对数据内所有数据批量转义的 方法
    // 保证数据转义后 
    $escape_data = $this->escapeStringAll($data);
    // 需要去引号 转义后带了引号了
    // $this->_table 真实表名调用
    $sql = sprintf("insert into $this->_table values (null,%s,%s,%s,'',%s,%s,%s,%s,%s)", $escape_data['goods_name'], $escape_data['goods_price'], $escape_data['goods_image'], $escape_data['goods_desc'], $escape_data['goods_number'], $escape_data['goods_status'], $escape_data['goods_recommend'], $escape_data['create_admin_id']);


    return $this->_dao->query($sql);
  }
}