<?php
// 商品属性控制器
class AttributeController extends Controller {

    // 展示属性添加
    public function addAction(){
        // 获取所有对应商品类型
      
        $typeModel = new TypeModel('goods_type');
        $types =  $typeModel->getTypes();
        include CUR_VIEW_PATH . 'goods_attr_add.html';
    }
    // 属性插入
    public function insertAction(){
      // 得到数据信息
      $data['attr_name'] = trim($_POST['attr_name']) ;
      $data['type_id'] = $_POST['type_id'];
      $data['attr_type'] = $_POST['attr_type'];
      $data['attr_input_type'] = $_POST['attr_input_type'] ;
      $data['attr_value'] = isset($_POST['attr_value'])?$_POST['attr_value']:'' ;

        //   echo '<pre>';
        //   var_dump($data);

        // 验证
        if( $data['attr_name'] == ""){
            $this->jump('index.php?p=admin&c=attribute&a=add','属性名称不能为空');
        }
        // 载入辅助函数
        $this->helper('input');
        $data = deepslashes( $data);
        $data = deepspecialchars( $data);
        // 创建模型 
        $attrModel = new AttributeModel('attribute');
        if( $attrModel->insert($data)){
            $this->jump('index.php?p=admin&c=type&a=index','添加成功',2);
        }else{
            $this->jump('index.php?p=admin&c=attribute&a=add','添加失败');
        }

    }
    // 属性展示列表
    public function indexAction(){
        $attrModel = new AttributeModel('attribute');
        // 获取所有的商品类型
        $typeModel = new TypeModel('goods_type');
        $types =  $typeModel-> getTypes();
        // echo '<pre>';
        // var_dump($types);
        // die;
        //获取所有数据
        // $attr_list =  $attrModel->getAttributies($type_id); 
        // 显示对应类型的所有属性
        $type_id = $_GET['id'] + 0;
      
        $current = isset($_GET['page'])?$_GET['page'] : 1;  // 当前页
        $pagesize = 1;  // 每页显
        $offset = ($current-1)*$pagesize;

        // 分页获取数据
        $attr_list =  $attrModel->getPageAttrs($type_id, $offset,$pagesize);
        //实例化分页类 载工具类
        $this->library('Page');
        $where= "type_id=$type_id"; //条件为空
        $total =$attrModel->total( $where);
 
       
        $p = new Page($total,$pagesize,$current,'index.php',array('p'=>'admin','c'=>'attribute','a'=>'index','id'=>$type_id));
        $page = $p->showPage();
        include  CUR_VIEW_PATH . 'goods_attr_list.html';
    }

}