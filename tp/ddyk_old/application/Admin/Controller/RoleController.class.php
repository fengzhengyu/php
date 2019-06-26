<?php
namespace Admin\Controller;

class RoleController extends CommonController{

  public function index(){
    $trans =I();
    $search = $trans['search'];
    if(!empty($search)){
      $where = "role_name like '%" .$search."%'";
    }else{
      $where = '';
    }
    // 计算数据总数
    $count = D('role')->pages($where);

    // 实例化分页

    $pageModel = new \Think\Mypage($count,10);
    $page = $pageModel->show();
    $limit = $pageModel->firstRow .','.$pageModel->listRows;
    $list = D('Role')->select($list,$where);

    $this->assign('search',$search);
    $this->assign('list',$list);
    $this->assign('page',$page);
    $this->display();
  }

  public function add(){
   
    $this->display();
  }
  public function insert(){
   $trans = I();
  $data['role_id'] = $trans ['role_id'];

  // 不为空 且为数字 是编辑
   if(!empty($data['role_id'])&&is_numeric($data['role_id'])){

   }else{ 
    //  添加
    $data['role_name'] =   $trans['role_name'];
   

    if(!empty($data['role_name'] && is_numeric($data['role_name']))){
      $res['code'] = 0;
      $res['message'] = '角色名不正确';
      $this->ajaxReturn($res);
    }
    $data['add_time'] =   time();

    if($info = D('Role')->insert($data)){
      $res['code'] = 200;
      $res['message'] = '添加成功';
      $res['data'] = $info;
      $this->ajaxReturn($res);

    }else{
      $res['code'] = 0;
      $res['message'] = '添加失败';
      $this->ajaxReturn($res);
    }
    dump($data);

   }
    
  }
}