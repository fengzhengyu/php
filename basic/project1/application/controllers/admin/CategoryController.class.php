<?php

// 商品分类控制器
class CategoryController extends Controller
{

  // 分类列表
  public function indexAction()
  {
    $categoryModel = new CategoryModel('category');
    $cats = $categoryModel->getCats();
    //  echo 'list page';
      //  echo '<pre>';
      // var_dump( $cats);
      // die;
    include CUR_VIEW_PATH . 'cat_list.html';
  }
  // 展示添加分类动作
  public function addAction()
  {

    $categoryModel = new CategoryModel('category');
    $cats = $categoryModel->getCats();

      // echo '<pre>';
      // var_dump( $cats);
      // die;
    include CUR_VIEW_PATH . 'cat_add.html';
  }

     
  // 添加插入分类动作
  public function insertAction()
  {
      // echo ('<pre>');
      // var_dump($_POST);
      // 1 收集表单数据
    $data['cat_name'] = trim($_POST['cat_name']);
    $data['parent_id'] = $_POST['parent_id'];
    $data['unit'] = trim($_POST['unit']);
    $data['cat_order'] = trim($_POST['cat_order']);
    $data['is_show'] = $_POST['is_show'] == 'on' ? 1 : 0;
    $data['cat_desc'] = trim($_POST['cat_desc']);

    // 批量转义 防止Xss
    $this->helper('input');
    $data =deepslashes($data); //符号转义
    $data =  deepspecialchars($data);

  

      // 2 验证及处理
    if ($data['cat_name'] === "") {
      $this->jump('index.php?p=admin&c=category&a=add', '分类名称不能为空');
    }
      // 3 调用模型 完成入库 并给出提示

    $categoryModel = new CategoryModel('category');
    if ($categoryModel->insert($data)) {
      $this->jump('index.php?p=admin&c=category&a=index', '添加分类成功', 2);
    } else {
      $this->jump('index.php?p=admin&c=category&a=add', '分类添加失败');
    }
    echo '插入';
  }

  // 载入编辑分类动作
  public  function editAction(){
    $categoryModel = new CategoryModel('category');
    //获取分类列表
    $cats = $categoryModel->getCats();

    $pid = isset($_GET['id'])?$_GET['id']:'';
    if($pid === ""){
      $this->jump('index.php?p=admin&c=category&a=index','分类ID不存在');
    }
    //获取分类信息
    $cat = $categoryModel->getEdit($pid);
    // echo '<pre>';
    // var_dump( $cat);
    include CUR_VIEW_PATH . 'cat_edit.html';
  }

  //跟新分类动作
  public  function updateAction(){
    // echo 'update page';

    $data['cat_name'] = trim($_POST['cat_name']);
    $data['parent_id'] = $_POST['parent_id'];
    $data['unit'] = trim($_POST['unit']);
    $data['cat_order'] = trim($_POST['cat_order']);
    $data['is_show'] = isset($_POST['is_show']) == 'on' ? 1 : 0;
    $data['cat_desc'] = trim($_POST['cat_desc']);
    $data['cat_id'] = trim($_POST['cat_id']);
    if ($data['cat_name'] === "") {
      $this->jump("index.php?p=admin&c=category&a=edit&id={$_POST['cat_id']}", '分类名称不能为空');
    }
    // 不能将当前节点 及子节点作为上级节点
    $categoryModel = new CategoryModel('category');
    // 找当前节点的所有子节点
    $ids= $categoryModel->getSubIds( $data['cat_id']);
    // 将当前节点id 合并进去
    $ids[] = $data['cat_id'];

    if(in_array($data['parent_id'],$ids)){
      $this->jump("index.php?p=admin&c=category&a=edit&id={$_POST['cat_id']}", '不能将当前节点作为上级节点');
    }
   
    // 批量转义 防止Xss
    $this->helper('input');
    $data =deepslashes($data); //符号转义
    $data =  deepspecialchars($data);
  
    if($categoryModel->update($data)){
      $this->jump('index.php?p=admin&c=category&a=index', '更新成功', 2);
    }else{
      $this->jump("index.php?p=admin&c=category&a=edit&id={$_POST['cat_id']}", '更新失败');
    }
  }

  //删除分类动作
  public function deleteAction(){
   
    // 获取删除id
    $cat_id = $_GET['id']+0;
    $categoryModel = new CategoryModel('category');
    // 
    // 删除分类 不是叶子分类（最底层），做一些处理，有两种：
    // 1 找其子孙分类，将其删除
    // 2 给出相应的提示 推荐
    $ids= $categoryModel->getSubIds( $cat_id);
    if(!empty($ids)){
      $this->jump("index.php?p=admin&c=category&a=index", '当前分类包含子类，请先删除子类');
    }
   
    // 调用模型 
 
    if($categoryModel->delete($cat_id)){
      $this->jump('index.php?p=admin&c=category&a=index', '删除成功', 2);
    }else{
      $this->jump("index.php?p=admin&c=category&a=index", '删除失败');
    }
  }
  
    
}