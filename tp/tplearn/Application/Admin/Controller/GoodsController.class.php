<?php
namespace Admin\Controller;
// use Think\Controller;
class GoodsController extends CommonController {
  public function _initialize(){
    parent::_initialize();
  }
  // 商品列表
  public function index(){
    // $list = M('Goods')->order('goods_id desc')->select();
   
    // dump( $list);

    // 分页
    $model =  M('Goods');
    $listcount = $model->count(); // 获取总记录数
   
    $page = new \Think\Page($listcount,10);
    $page->rollPage = 5;  // 分页栏每页显示的页数
    $page->lastSuffix = false;   // 最后一页是否显示总页数
    $page->setConfig('prev','[上一页]');
    $page->setConfig('next','[下一页]');
    $page->setConfig('first','[首页]');
    $page->setConfig('last','[未页]');
    $page->setConfig('header','<span class="rows">当前是 %NOW_PAGE%/%TOTAL_PAGE%页, 共 %TOTAL_ROW% 条记录 </span>');

    $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');

   

    $start = $page->firstRow;
    $pageSize = $page->listRows;
    $list = $model->order('goods_id desc')->limit($start,$pageSize)->select();
    foreach($list as $k=>$v){
      // 图片前缀路径
      $list[$k]['goods_image'] = C('ADDRESS_NAME_KEY').$v['goods_image'];
    }

    $this->assign('list',$list);
    $this->assign('page', $page->show());
    

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
      // 处理上传图片
      
      if($_FILES['goods_image']['error'] == 0){
        $upload = new \Think\Upload();
        $upload->rootPath = './Public/uploads/';  //设置附件上传根目录
        // $upload->maxSize   =     102400;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $info = $upload->upload();
      
        if(!$info){
          $this->error($upload->getError()); //错误信息

        }else{
          // 长传成功
          foreach($info as $file){
          
            $goods_image= $file['savepath'] . $file['savename'];

          
          }
        }
        // 缩略图
        $thumb = new \Think\Image();
        $thumb->open($upload->rootPath . $goods_image); //找到原图
        $thumb->thumb(60,60); //制作统一图
        $small_img = $upload->rootPath.$file['savepath']."small_".$file['savename'];
        $thumb->save($small_img); //保存错略图
        $small_img_url = $file['savepath']."small_".$file['savename'];

      }
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
      // 图片
      $data['goods_image'] =  $goods_image;
      $data['goods_cover'] =  $small_img_url;


     


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
    header('Content-Type:text/html;charset=utf8');
    $goods_id = I('goods_id');
    $goods= M('Goods')->find($goods_id);
    // 处理推荐多选
    $goods['goods_recommend'] = explode(',',$goods['goods_recommend']);
   
    // dump($goods['goods_recommend']);
   
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