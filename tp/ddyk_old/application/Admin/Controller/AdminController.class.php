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
    $list =  D('Admin')->select($limit,$where, $field );
    // dump($list );
    $this->assign('search',$search);
    $this->assign('list',$list);
    $this->assign('page',$page);
    $this->display();
  }
  // 
 
}