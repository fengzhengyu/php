<?php
namespace Admin\Controller;
use Think\Controller;
class LayoutController extends Controller {

  // 基础模板
  public function base(){
 
    $this->display();
  }
}