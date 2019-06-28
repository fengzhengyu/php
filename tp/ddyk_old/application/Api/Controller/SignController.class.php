<?php
namespace Api\Controller;
use Think\Controller\RestController;
class SignController extends RestController{
  
  protected $allowMethod    = array('get','post'); // REST允许的请求类型列表
  protected $allowType      = array('json'); // REST允许请求的资源类型列表

  public function checkMessage(){
    $data['code'] = 200;
    $data['msg'] = '验证成功！';
    $data['data'] = array(1,2,3,4,5,6);
    $this->response($data,'json');
  }

  public function index(){
    $pass = '123456';
    $key = 'lodasdf';
    echo encrypt($key, $pass);

  }

  public function indexj(){
    $c_t = 'QArngeQD';
    $key = 'lodasdf';
    echo decrypt($key,$c_t);
  }

 
}