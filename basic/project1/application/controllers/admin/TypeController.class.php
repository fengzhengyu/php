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

}