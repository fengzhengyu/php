<?php
namespace Api\Controller;
use Think\Controller\RestController;
class SignController extends RestController{
  
  protected $allowMethod    = array('get','post'); // REST允许的请求类型列表
  protected $allowType      = array('json'); // REST允许请求的资源类型列表

  // 发送验证码
  public function sendCode(){
    $trans = I();
    if(empty($trans['phone'])){
      $result['code'] = 0;
      $result['msg'] = '用户名不能为空';
      $this->response($result,'json');
    }
    // if (!preg_match("/^1[3456789]{1}\d{9}$/", trim($trans['phone']))) {
    //   $result['code'] = 0;
    //   $result['msg'] = '手机号错误';
    //   $this->response($result, 'json');
    // }
    $phone =trim($trans['phone']);
    
    $wherePhone['phone']= $phone;
    $field ="phone";
    $findPhone = D('member')->findMember($wherePhone, $field );
    if($findPhone){
      $result['code'] = 0;
      $result['msg'] = '该用户已经注册';
      $this->response($result,'json');
    }
    $authCode =  authCode($phone);

    $result['code'] = 200;
    $result['msg'] = '验证获取成功！';
    $result['data'] = $authCode;
    $this->response($result,'json');
  }


  public function register(){

    $trans = I();
    if(empty($trans['phone'])){
      $result['code'] = 0;
      $result['msg'] = '用户名不能为空';
      $this->response($result,'json');
    }
    if(empty($trans['password'])){
      $result['code'] = 0;
      $result['msg'] = '密码不能为空';
      $this->response($result,'json');
    }
    if(empty($trans['authCode'])){
      $result['authCode'] = 0;
      $result['msg'] = '验证码不能为空';
      $this->response($result,'json');
    }



     //调用验证码函数并判断
     $verify = authCode(trim($trans['phone']));
     if($trans['authCode'] != $verify){
      $result['code'] = 0;
      $result['msg'] = '验证码错误或者过期';
      $this->response($result,'json');
     }

    //  调用token 值
    $memberData['member_token'] = guid();
    $memberData['member_pass'] =  D('Member')->encrypt(C('SECRET_KEY'),$trans['password']);
    $memberData['member_phone'] = $trans['phone'];
    $memberData['member_type'] = 1;
    $memberData['member_email'] = '';
    $memberData['member_status'] = 1;
    $memberData['add_time'] = time();
    $memberData['nickname'] = '匿名';

    $insertMemberData = D('Member')->insertMember($memberData);

     if($insertMemberData){
      $data['member_token'] =  $memberData['member_token'];
      $data['add_time'] = date("Y-m-d",$memberData['add_time']);
      $data['nickname'] = $memberData['nickname'];
      $data['member_phone'] =$memberData['member_phone'];


      $result['code'] = 200;
      $result['msg'] = '注册成功';
      $result['data'] = $data;
      $this->response($result,'json');

     }else{
      $result['code'] = 0;
      $result['msg'] = '注册失败,请联系网站技术人员';
      $this->response($result,'json');
     }
   
  }

  // 登录
  public function login(){
    $trans = I();
    if(empty($trans['phone'])){
      $result['code'] = 0;
      $result['msg'] = '用户名不能为空';
      $this->response($result,'json');
    }
    if(empty($trans['password'])){
      $result['code'] = 0;
      $result['msg'] = '密码不能为空';
      $this->response($result,'json');
    }
    $where['member_phone'] = trim($trans['phone']);
    $field = "member_token,member_phone,nickname,member_email,add_time,member_type";
    $data = D('Member')->findMember($where,$field);

    $key = C('SECRET_KEY');
    if($data){
      $where['member_pass'] =D('Member')->decrypt($key,$trans['password']);
      $dataLogin = D('Member')->findMember($where,$field);

      if($dataLogin){

        $result['code'] = 200;
        $result['msg'] = '登陆成功';
        $result['data'] =  $dataLogin;
        $this->response($result,'json');
      }else{
        $result['code'] = 0;
        $result['msg'] = '密码错误';
        $this->response($result,'json');
      }

    }else{
      $result['code'] = 0;
      $result['msg'] = '未注册';
      $this->response($result,'json');
    }


  }
 
}