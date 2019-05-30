<?php
  // 商品相关的控制器
  class GoodsController extends PlatformController {

    public function addAction(){
      // echo 'add page';
      require CURRENT_VIEW_PATH . 'goods_add.html';
    }

    //  商品插入

    public function insertAction(){
      // 收集数据 
      $data['goods_name'] = $_POST['goods_name'];
      $data['goods_price'] = $_POST['goods_price'];
      $data['goods_desc'] = $_POST['goods_desc'];
      $data['goods_number'] = $_POST['goods_number'];
      $data['goods_status'] = $_POST['goods_status']=='on'?1:0;
      $arr= array();
      if(isset($_POST['goods_recommend'])){
        foreach($_POST['goods_recommend'] as $key=>$value){
       
          if($value == 'on'){
            $arr[] =str_replace("'","",$key) ;
          }
        }
      }
     
      $data['goods_recommend']=  isset($_POST['goods_recommend'])? implode(',',$arr): '';

      // 上传图片
      $upload_img = new UploadImage();
      // 设置上传路径
      $upload_img->_upload_path= './web/upload/';
      // 设置前缀
      $upload_img->_prefix= 'goods_img_';
      if($result= $upload_img->uploadOne($_FILES['goods_image'])){
        // 
        $data['goods_image'] =  $result;
       
      }else{
        $this->_jump('index.php?p=admin&c=Goods&a=add',$upload_img->getError());
       
      }
      // $data['goods_name'] = $_POST['goods_name'];
      // 通过模型插入数据表
        $m_goods = Factory::M('GoodsModel');

      // 根据插入结果，给出提示
      if($m_goods->insertGoods($data)){
        $this->_jump('index.php?p=admin&c=Goods&a=list');
      }else{
        $this->_jump('index.php?p=admin&c=Goods&a=add','失败原因');
      }

      // echo '<pre>';
      // var_dump($_POST);
    }
    // list page
    public function listAction(){
      $m_goods = Factory::M('GoodsModel');
      // echo 'list page';
      // echo '<pre>';
  
      $pageSize =isset($_GET['num'])?$_GET['num']:10; //每页显示几条
      $pageNow =isset($_GET['page'])?$_GET['page']:1; //页码
 
     
      $pageCount =0;

      $goods_list = $m_goods->listGoods($pageNow,$pageSize,$pageCount);
      // var_dump(  $goods_list);
      require CURRENT_VIEW_PATH . 'goods_list.html';
    }

  }