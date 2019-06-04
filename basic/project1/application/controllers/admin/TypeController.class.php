<?php
// 商品分类 控制器
class TypeController extends Controller {


    // 展示添加页面
    public function addAction(){
        include CUR_VIEW_PATH . 'goods_type_add.html';
    }
    // 插入页面
    public function insertAction(){
        // 接受表单数据
        $data['type_name'] = trim( $_POST['type_name']);
        // 验证处理

        if($data['type_name'] == ''){
            $this->jump('index.php?p=admin&c=type&a=add','商品类型名称不能为空');
        }
        // 辅助函数
        $this->helper('input');
        $data =deepslashes($data);
        $data = deepspecialchars($data);
        // 调用模型完成插入
        $typeModel = new TypeModel('goods_type');
        if($typeModel->insert( $data)){
            $this->jump('index.php?p=admin&c=type&a=index','添加商品类型成功',2);
        }else{
            $this->jump('index.php?p=admin&c=type&a=add','添加失败');
        }
    }
    // 展示添加页面
    public function indexAction(){
        // 获取类型列表
        $typeModel = new TypeModel('goods_type');
        // $type_list =  $typeModel->getTypes();

        // 获取当前分页数 url获取 page 
        $current = isset($_GET['page'])?$_GET['page'] : 1;
        $pagesize = 10;
        $offset = ($current - 1 )* $pagesize;
        $type_list = $typeModel->getPageTypes($offset,$pagesize);
        // 使用分页类 
        // 获取总数
        $where= ''; //条件为空
        $total = $typeModel->total($where);
        // 辅助类 page
        $this->library('Page');
        // 
        $p = new Page($total,$pagesize,$current,'index.php',array('p'=>'admin','c'=>'type','a'=>'index'));
        $page = $p->showPage();

        include CUR_VIEW_PATH . 'goods_type_list.html';
    }

    // 展示编辑 页面
    public function editAction(){
        $type_id = $_GET['id']+0;
        $typeModel = new TypeModel('goods_type');
         $type =  $typeModel->getEdit($type_id);

        include CUR_VIEW_PATH . 'goods_type_edit.html';

    }
    // 更新数据
    public function updateAction(){
        // 接受表单数据
        $data['type_id'] = trim( $_POST['type_id']);
        $data['type_name'] = trim( $_POST['type_name']);
        $typeModel = new TypeModel('goods_type');
        // 辅助函数
        $this->helper('input');
        $data =deepslashes($data);
        $data = deepspecialchars($data);
        if( $typeModel->update($data)){
            $this->jump('index.php?p=admin&c=type&a=index','更新成功',2);
        }else{
            $this->jump('index.php?p=admin&c=type&a=edit&id='.$data['type_id'],'更新失败');
        }
          
    }
     // 删除数据
     public function deleteAction(){
        $type_id = $_GET['id']+0;
        $typeModel = new TypeModel('goods_type');
        if($typeModel->delete( $type_id)){
            $this->jump('index.php?p=admin&c=type&a=index   ','删除成功');
        }else{
            $this->jump('index.php?p=admin&c=type&a=edit&id='.$data['type_id'],'删除失败');
        }
     }

}