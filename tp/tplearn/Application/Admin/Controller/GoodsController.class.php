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
  
    $this->display();
  }

  public function doadd(){
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
    // 自动获取form数据
    $goods= M('Goods');
    if(IS_POST){
      $data = $goods->create();
      // create 以后可以对数据进行操作
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
      if($goods->add($data)){
        $this->success('添加成功','index',2);
      }else{
        $this->error('添加失败');
      }
     
    }

    // 方法三 I('变量类型，变量名称','default','filter','要获取的额外数据源')获取的post 或者get 参数
    

  }
   // 商品更新
  //  
   public function edit(){
    $goods_id = I('goods_id');
    $goods= M('Goods')->find($goods_id);
    // 处理推荐多选
    $goods['goods_recommend'] = explode(',',$goods['goods_recommend']);
   
    $this->assign('data',$goods);
    $this->display();
  }
   // 商品更新
   public function update(){
    if(IS_POST){
      $goods= M('Goods');
      $data = $goods->create();
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
    
     
      if($goods->save($data)){
        $this->success('修改成功','index',2);
      }else{
        $this->error('修改失败');
      }

    }
  }
    // 商品删除
    public function delete(){
      $goods_id = I('goods_id');
     
      if( M('Goods')->delete($goods_id)){
        $this->success('删除成功',U('index'),2);
      }else{
        $this->error('删除失败');
      }
    }
}