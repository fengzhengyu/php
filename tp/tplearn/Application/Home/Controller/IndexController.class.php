<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }

    public function add(){
        header('Content-Type:text/html;charset=utf-8;');
        echo '<pre>';
        // var_dump(get_defined_constants(true));
        // $this->display();//当前控制器的当前方法
        echo __SELF__.'<BR>'; //当前文件地址
        echo __MODULE__ .'<BR>'; //当前分组
        echo __CONTROLLER__ .'<BR>'; //当前控制器
        echo __ACTION__ .'<BR>'; //当前文件地址
        echo '获取数据库主机'  .  C('DB_HOST');
      
    }

    public function test(){
        header('Content-Type:text/html;charset=utf-8;');
        // $Category = new \Home\Model\CategoryModel();
        // $Category = M('category'); //实例化父类model
        $Category = D('category'); // 相当于CategoryModel;
       $list =  $Category->select();
       dump( $list);
    }

    // 当方法找不到 也可以指向这个空操作
    public function _empty(){
        echo '非法操作！';
    }
}