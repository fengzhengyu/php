<?php
namespace Admin\Controller;
class AuthorityController extends CommonController {

  public function index(){
    $list = M('auth')->select();
    $this->assign('list',$list);
    $this->display();
  }
  // add
  public function add(){
    $model = M('auth');

    $parent_auth = $model->where('auth_level=0')->select();
    $this->assign('parent_auth',$parent_auth);
    $this->display();
  }
  // confirmAdd
  public function confirmAdd(){
    $model= M('auth');
    if($data = $model->create()){
      
     
      if($auth_id = $model->add($data)){ // 先添加进去 找主键 
        $info= array();
        if($data['auth_pid'] == 0){
          $info['auth_path'] =  $auth_id;
          $info['auth_level'] =  0;
  
        }else{
          $info['auth_path'] = $data['auth_pid'].'-'.$auth_id;
          $info['auth_level'] =  1;
  
        }
        $info['auth_id'] =  $auth_id;

        if($model->save( $info)){
          $this->success('添加成功','index',2);
        }else{
          $this->success('添加失败');
        }
      }else{
        $this->success('添加失败');
      }
    }
  }
  // edit
  public function edit(){
    $model = M('auth');
  
    $current_auth =   $model->find($_GET['auth_id']); //通过传递来的auth_id  获得当前数据

   
    $parent_auth = $model->where('auth_level=0')->select();

    $this->assign('current_auth',$current_auth);
    $this->assign('parent_auth',$parent_auth);
    $this->display();

  }
  // 跟新
  public function update(){
     $model= M('auth');
    if($data = $model->create()){
    
      if($data['auth_pid'] == 0){
        $data['auth_c'] = '';
        $data['auth_a'] = '';
        $data['auth_level'] = 0;
        $data['auth_path'] = $data['auth_id'];
      }else{
        $data['auth_level'] =1;
        $data['auth_path'] = $data['auth_pid'].'-'.$data['auth_id'];
      }
      // dump($data);
      if($model->save($data)){
        $this->success('修改成功','index',2);
      }else{
        $this->success('修改失败');
      }

    }
  }
}