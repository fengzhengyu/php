<?php
// 商品控制器
class GoodsController extends Controller {
    // 载入商品添加页面
    public function addAction(){
        // echo 'goods';

        include CUR_VIEW_PATH . 'goods_add.html';
    }
}