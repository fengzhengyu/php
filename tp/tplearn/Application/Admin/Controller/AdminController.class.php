<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller {
  
    public function  index(){
      $data['time'] = date('Y-m-d H:i:s');

      $this->assign('data',$data);
      $this->display();
    }

    // 验证码
    public function verifyImg(){

      $config= array(
        'imageW'=> 140,
        'imageH'=> 40,
        'fontSize'=> 20,
        'fontttf'=> '4.ttf'

      );
      $verify= new \Think\Verify( $config);
      $verify->entry();
    //  dump( );


    }
}