<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends Controller {

  // 商品列表
  public function index(){
    $list = M('Goods')->order('goods_id desc')->select();

    foreach($list as $k=>$v){
      // 图片前缀路径
      $list[$k]['goods_image'] = C('ADDRESS_NAME_KEY').$v['goods_image'];
    }
    // dump( $list);
    $this->assign('list',$list);
    $this->display();
  }
   // 商品添加页面
   public function add(){
    //  方法一
    //  if(!empty($_POST)){
    //    $data['goods_name'] = $_POST['goods_name'];
    //    $data['goods_price'] = $_POST['goods_price'];
    //    $data['goods_number'] = $_POST['goods_number'];
    //    $data['goods_desc'] = $_POST['goods_desc'];
    //    $data['goods_status'] = isset($_POST['goods_status'])?1:0;
    //    $arr= array();
    //    if(isset($_POST['goods_recommend'])){
    //     foreach($_POST['goods_recommend'] as $k=>$v){
        
    //       if($v == 'on'){
    //         $arr[] =str_replace("'","",$k) ;
    //       }
    //     }
    //    }
    //    $data['goods_recommend']=  isset($_POST['goods_recommend'])? implode(',',$arr): '';
    //   if( M('Goods')->add($data)){
    //     $this->redirect('index',array(),2,'添加成功！');
    //   }else{
    //     $this->redirect('add',array(),3,'添加失败！');
    //   }
      
    //  }

    // 方法二 
    if(IS_POST){
      $data= M('Goods')->create();
      $arr =array();
      if(is_array($data['goods_recommend'])){
        foreach($_POST['goods_recommend'] as $k=>$v){
          if($v=='on'){
            $arr[] =str_replace("'","",$k) ;
          }
        }
      }
      $data['goods_recommend']=  isset($data['goods_recommend'])? implode(',',$arr): '';
      $data['goods_status'] = isset($data['goods_status'])?1:0;
      dump($data);
    }
    $this->display();
  }
   // 商品更新
   public function update(){
    $this->display();
  }
    // 商品删除
    public function delete(){
      
    }
}