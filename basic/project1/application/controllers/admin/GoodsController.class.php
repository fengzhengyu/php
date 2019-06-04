<?php
// 商品控制器
class GoodsController extends Controller {
    // 载入商品添加页面
    public function addAction(){
        // echo 'goods';
        $catModel = new CategoryModel('category');
        $cats = $catModel->getCats();
        $brandModle = new BrandModel('brand');
        $brands = $brandModle->getBrands();
        $typeModel = new TypeModel('goods_type');
        $types = $typeModel->getTypes();
        
        // echo '<pre>';
        // var_dump($cats);

        include CUR_VIEW_PATH . 'goods_add.html';
    }
    // 商品入库
    public function insertAction(){

        // 1 手机信息
        $data['goods_name'] = $_POST['goods_name'];
        $data['goods_cn'] = $_POST['goods_cn'];
        $data['cat_id'] = $_POST['cat_id'];
        $data['brand_id'] = $_POST['brand_id'];
        // $data['belong_id'] = $_POST['belong_id'];
        $data['shop_price'] = $_POST['shop_price'];
        $data['promote_price'] = $_POST['promote_price'];
        $data['is_promote'] = $_POST['is_promote'];
        $data['promote_strat_time'] = strtotime($_POST['promote_strat_time']);
        $data['promote_end_time'] = strtotime($_POST['promote_end_time']);
        // $data['goods_img'] = $_POST['goods_img'];
        // $data['goods_img_url'] = $_POST['goods_img_url'];
        // $data['goods_thumb'] = $_POST['goods_thumb'];
        // $data['goods_thumb_url'] = $_POST['goods_thumb_url'];
        // $data['goods_thumb_status'] = $_POST['goods_thumb_status'];

        // uplaod 图片
        $this->library('Upload');
        $upload = new Upload();
        $upload->_upload_path = './public/uploads/goods/';
        if($img =  $upload->uploadOne($_FILES['goods_img'])){
            $data['goods_img'] = $img;
        }else{
            $this->jump('index.php?p=admin&c=goods&a=add', $upload->getError());
        }

        $data['goods_desc'] = $_POST['goods_desc'];

        // $data['goods_weight'] = $_POST['goods_weight'];
        // $data['goods_unit'] = $_POST['goods_unit'];
        $data['goods_number'] = $_POST['goods_number'];
        // $data['goods_number_warning'] = $_POST['goods_number_warning'];
        $data['is_best'] = isset($_POST['is_best'])?1:0;
        $data['is_new'] = isset( $_POST['is_new'])?1:0;
        $data['is_hot'] = isset($_POST['is_hot'])?1:0;
        $data['is_onsale'] = $_POST['is_onsale'];
        $data['is_ordinary'] = $_POST['is_ordinary']; //打勾表示能作为普通商品销售
        $data['keyword'] = $_POST['keyword']; //
        $data['goods_brief'] = $_POST['goods_brief']; //
        // type_id 
        $data['type_id'] = $_POST['type_id']; //
        $data['add_time'] = date('Y-m-d h:i:s', time()); //

        // attr_value_list  attr_id_list attr_price_list 获取商品属性
        // $attrs_ids = $_POST['attr_id_list'] ;
        // $attrs_values = $_POST['attr_value_list'] ;
        // $attrs_prices = $_POST['attr_price_list'] ;

           echo '<pre>';
        var_dump($data);
        die;


        // 2 验证处理 
        $this->helper('input');
        $data = deepslashes($data);
        $data = deepspecialchars($data);
        // 3 调用模型完成
        $goodsModel = new GoodsModel('goods');
        //    获取插入id
        if($goods_id = $goodsModel->insert($data)){
            // if($data['type_id'] == "") return;
            $attrs_ids = $_POST['attr_id_list'] ;
            $attrs_values = $_POST['attr_value_list'] ;
            $attrs_prices = $_POST['attr_price_list'] ;
            // 需要批量插入
            foreach($attrs_ids as $k => $v){
                // 构造关联数组
                $list['goods_id'] = $goods_id;
                $list['attr_id'] = $v;
                $list['attr_value'] =  $attrs_values[$k];
        
                // 调用模型
                $emptyModel = new Model('goods_attr');
               if( $emptyModel->insert($list)){
                $this->jump('index.php?p=admin&c=goods&a=index', '插入成功！');
               }else{
                $this->jump('index.php?p=admin&c=goods&a=add', '插入属性失败！');
               }

            }
    
            


        }else{
            $this->jump('index.php?p=admin&c=goods&a=add', '插入商品失败！');
        }

    }

    // 商品展示列表
    public function indexAction(){
        $goodsModel = new GoodsModel('goods');


        $goods_list = $goodsModel->getGoods();
        //  echo '<pre>';
        // var_dump($goods_list);
        include CUR_VIEW_PATH . 'goods_list.html';
    }
}