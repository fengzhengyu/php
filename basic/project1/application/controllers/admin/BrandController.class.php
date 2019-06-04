<?php

// 品牌控制器
class BrandController extends Controller {
  // 展示添加品牌页面
  public function addACtion(){
    include CUR_VIEW_PATH . 'brand_add.html';
  }
  // 插入品牌功能
  public function insertACtion(){
    $data['brand_name'] = trim($_POST['brand_name']);
    $data['brand_url'] = trim($_POST['brand_url']);
    $data['brand_desc'] = $_POST['brand_desc'];
    $data['brand_order'] = trim($_POST['brand_order']);
    $data['is_show'] = $_POST['is_show'] == 'on'?1:0;

    // 做一些判断
   
    if( $data['brand_name'] == ""){
      $this->jump('index.php?p=admin&c=brand&a=add','品牌名称不能为空');
    }
    // 载入辅助类 upload
    $this->library('Upload');
    $upload = new Upload();
    // 设置上传路径
    $upload->_upload_path= './public/uploads/brand/';
    // 设置前缀
    $upload->_prefix= 'brand_';

    if($result= $upload->uploadOne($_FILES['brand_logo'])){
      $data['brand_logo'] = $result;
    }else{
      $this->jump('index.php?p=admin&c=brand&a=add',$upload->getError());
    }
    // 载入辅助函数 转义字符
    $this->helper('input');
    $data = deepslashes($data);
    $data = deepspecialchars($data);

    // 调用模型 
    $brandModel = new BrandModel('brand');

    if($brandModel->insert($data)){
      $this->jump('index.php?p=admin&c=brand&a=index','插入成功！',2);
    }else{
      $this->jump('index.php?p=admin&c=brand&a=add','插入失败！');
    }
  

    // echo '<pre>';
    // var_dump($data);
  }

  // 展示 品牌列表
  public function indexAction(){
    $brandModel= new BrandModel('brand');
    $brands = $brandModel->getBrands();
    // echo '<pre>';
    // var_dump($brands);

    include CUR_VIEW_PATH . 'brand_list.html';
  }
  // 展示 编辑页面
  public function editAction(){
    $brand_id = $_GET['id']+0;

    if( $brand_id == ""){
      $this->jump('index.php?p=admin&c=brand&a=index','分类ID不存在');
    }
    // 获取编辑信息
    $brandModel= new BrandModel('brand');
    $brand = $brandModel->getEdit($brand_id);
    // echo '<pre>';
    // var_dump($brand);
    include CUR_VIEW_PATH . 'brand_edit.html';
  }
  // 展示 更新功能
  public function updateAction(){
    $brandModel= new BrandModel('brand');
    $data['brand_id'] = $_POST['brand_id']+0;
    $data['brand_name'] = trim($_POST['brand_name']);
    $data['brand_url'] = trim($_POST['brand_url']);
    $data['brand_desc'] = $_POST['brand_desc'];
    $data['brand_order'] = trim($_POST['brand_order']);
    $data['is_show'] =isset( $_POST['is_show'])?1:0;

    // 如果更新logo 
    if($_FILES['brand_logo']['name'] != ''){
      // 载入辅助类 upload
      $this->library('Upload');
      $upload = new Upload();
      // 设置上传路径
      $upload->_upload_path= './public/uploads/brand/';
      // 设置前缀
      $upload->_prefix= 'brand_';
      if($result= $upload->uploadOne($_FILES['brand_logo'])){
        $data['brand_logo'] = $result;
      }else{
        $this->jump('index.php?p=admin&c=brand&a=edit&id='.$data['brand_id'],$upload->getError());
      }
    }

    // 载入辅助函数 转义字符
    $this->helper('input');
    $data = deepslashes($data);
    $data = deepspecialchars($data);
    // 更新
    if($brandModel->update($data)){
      $this->jump('index.php?p=admin&c=brand&a=index','更新成功！',2);
    }else{
      $this->jump('index.php?p=admin&c=brand&a=edit&id='.$data['brand_id'],'更新失败！');
    }
    //  echo '<pre>';
    //     var_dump($data);
    //     die;
   
    
  }
  // 展示 delete 功能
  public function deleteAction(){
    $brandModel= new BrandModel('brand');

    // echo '<pre>';
    // var_dump($brands);
    $brand_id = $_GET['id']+0;
    if($brandModel->delete($brand_id)){
      $this->jump('index.php?p=admin&c=brand&a=index','删除成功！',2);
    }else{
      $this->jump('index.php?p=admin&c=brand&a=edit&id='.$brand_id,'删除失败！');
    }
   
  }
}