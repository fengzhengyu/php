<?php
namespace Admin\Controller;

use Think\Mypage;


class AdminController extends CommonController {

  public function  index(){
    // 取得所有用户
    // $where['status']  = 1; //>where( $where)->
    $trans = I();
    $search = $trans['search'];
    if(!empty($search)){
      $where = "admin_name like '%". $search ."%'";
    }else{
      $where = '';
    }

    // 计算数据总数量
    $count = D('Admin')->pages($where);

    // 分页实例
    $pageModel = new \Think\Mypage($count,10);
    $page = $pageModel->show();
    $limit = $pageModel->firstRow.','.$pageModel->listRows;
    // $field = "ddold_admin.* ,ddold_role.role_name";
    $list =  D('Admin')->select($limit,$where);
    // dump($list );
    $this->assign('search',$search);
    $this->assign('list',$list);
    $this->assign('page',$page);
    $this->display();
  }
  // 
  public function add(){
    $this->display();
  }
  public function insert(){
    $tarns = I();

    
    $data['admin_id'] = $tarns['admin_id'];
    if( !empty($data['admin_id']) && is_numeric($data['admin_id'])){
      // 编辑
    }else{
      // 添加
      $data['admin_name'] = $tarns['admin_name'];
      $data['admin_pass'] = $tarns['admin_pass'];
      $data['add_time'] = time();

      // dump( $data);
      if($info = D('admin')->insert($data)){
        $res['code'] = 200;
        $res['message'] = '添加成功';
        $res['data'] = $info;
        $this->ajaxReturn($res);
      }else{
        $res['code'] = 0;
        $res['message'] = '添加失败';
        $this->ajaxReturn($res);
      }
    }
   
  }
 
}