<?php
namespace  Admin\Controller;
use Think\Controller;

class GoodsController extends CommonController {


  // 分类列表
  public function type(){
    // 获取搜索数据
    $where['goods_pid'] = 0;
    $types =  M('goods_type')->where($where)->select();
    // 获取搜索框内容 拼接where条件便于搜索
    $trans = I();
    // 不为空 且不是数字
    $search = $trans['search'];
  
    if(!empty($search)&& is_numeric($search)){
      $selectWhere['goods_pid'] = $search;
    }else{
      $selectWhere= '';
    }
   
    // dump( $selectWhere);
    // die;

    $list = M('goods_type')->where( $selectWhere)->select();

    $this->assign('list',$list);
    $this->assign('search_id',$search);
    $this->assign('types',$types);
    $this->display();
  }

  // 添加分类
  public function add(){
    $trans = I();
    if($trans['id']){

      $type_info =  M('goods_type')->find($trans['id']);
      // dump($type_info);
      $this->assign('type_info',$type_info);
    }

    $this->display();
  }
  // 操作添加分类
  public function insertType(){

    $trans = I();
    if($trans['id']){

      // $data 
     
    }



    if(!empty($trans['goods_pname']) && !is_numeric($trans['goods_pname'])){

      $data['goods_pname'] = $trans['goods_pname'];
      $data['goods_pid'] = 0;
      $data['is_show'] = $trans['is_show'];
      $data['add_time'] = time();
     
      // dump(D('Goods')->insert());

      if($id= M('goods_type')->add($data)){
        $res['flag'] = 'success';
        $res['info'] = '添加成功';
        $res['data'] = array();
        $this->ajaxReturn($res);
      }else{
        $res['flag'] = 'error';
        $res['info'] = '添加失败';
        $this->ajaxReturn($res);
      }

      // echo 'ok';
    }else{
      $res['flag'] = 'error';
      $res['info'] = '输入名称不合法';
      $this->ajaxReturn($res);
    }
  }
  // 添加子分类
  public function addSub(){
    $where['goods_pid'] = 0;

    $sub_list =  M('goods_type')->where($where)->select();
    // dump($sub_list);
    $this->assign('sub_list',$sub_list);
    $this->display();
  }

   // 操作添加子分类
  public function insertSub(){

    $trans = I();
    if($trans['id']){

      // $data 
     
    }
   
    // 添加
    if(!empty($trans['goods_pid']) && is_numeric($trans['goods_pid']) && !empty($trans['goods_subname']) && !is_numeric($trans['goods_subname'])){
     
      $type_info = M('goods_type')->find($trans['goods_pid']);
      if(!$type_info ){
        $res['flag'] = 'error';
        $res['info'] = '父类id错误';
        $this->ajaxReturn($res);
      }

      $data['goods_pname'] = $type_info['goods_pname'];
      $data['goods_pid'] = $trans['goods_pid'];
      $data['goods_subname'] = $trans['goods_subname'];
      $data['is_show'] = $trans['is_show'];
      $data['add_time'] = time();
     
     

      if($id= M('goods_type')->add($data)){
        $res['flag'] = 'success';
        $res['info'] = '添加成功';
        $res['data'] = array();
        $this->ajaxReturn($res);
      }else{
        $res['flag'] = 'error';
        $res['info'] = '添加失败';
        $this->ajaxReturn($res);
      }

      // echo 'ok';
    }else{
      $res['flag'] = 'error';
      $res['info'] = '输入名称不合法';
      $this->ajaxReturn($res);
    }
  }

  // 
  // 商品列表
  public function index(){

    $this->display();

  }
}