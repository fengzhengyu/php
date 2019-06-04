<?php

// 
class Upload {

  protected $_max_size;         //最大值
  protected $_type_map;         //mime 映射数组
  protected $_allow_ext_list;   //后缀名数组
  protected $_allow_mime_list;    //mime 类型数组
  protected $_upload_path;      //上传路径
  protected $_prefix;           //前缀
  protected $_error;           //错误信息

  public function getError(){
    return $this->_error;
  }
  public function __construct()
  {
    $this->_max_size = 1024*1024;
    $this->_type_map = array(
      '.png'=>array('image/png','image/x-png'),
      '.jpg'=>array('image/jpeg','image/pjpeg'),
      '.jpeg'=>array('image/jpeg','image/pjpeg'),
      '.gif'=>array('image/gif')
    );
    $this->_allow_ext_list = array('.png','.jpg','.gif','.jpeg');
    $allow_mime_list = array();
    foreach($this->_allow_ext_list as $value){
      $allow_mime_list  = array_merge( $allow_mime_list,$this->_type_map[$value]);
    }
    // 去重
    $this->_allow_mime_list = array_unique($allow_mime_list);
    $this->_upload_path = './';

    $this->_prefix = '';
  }

  // 设置值
  public  function __set($name, $value) 
  {  //属性重载
    $allow_set_list = array('_upload_path','_prefix','_allow_ext_list','_max_size');
  // 可以不加： _进行设置
    if(substr($name,0,1) !=='_'){
      $name= "_".$name;
    }
    $this->$name = $value;
  }

    /**
     * 上传单个图片
     * @param $tmp_file 临时长传文件信息
     * @return string  返回成功的文件名 ，失败是false 
     * */ 
  public function uploadOne($tmp_file){
     // 是否存在错误
     if($tmp_file['error'] !=0){
      $this->_error= '文件上传错误';
      return false;
    }
    // 大小
  
    if($tmp_file['size']> $this->_max_size){
      $this->_error= '文件大于1M';
      return false;
    }
    // 类型
  
    // 后缀 从原始文件名中提取 strrchr
  
    $ext =  strtolower(strrchr($tmp_file['name'],'.')); //strtolower转换成小写
    if(!in_array($ext,$this->_allow_ext_list)){
      $this->_error= '类型不合法';
      return false;
    }


    // 获得真实文件类型
    // PHP 自己获取mime进行检查
    // $finfo = new finfo(FILEINFO_MIME_TYPE);
    // $mime_type = $finfo ->file($tmp_file['name']); //检测
    // echo $mime_type;
    
    if(!in_array($tmp_file['type'],$this->_allow_mime_list)){
      $this->_error= '类型不合法';
      return false;
    }
    // 移动位置
    // $upload_path = './';
    // 创建子目录
    $subdir = date('YmdH') .'/';
    if(!is_dir($this->_upload_path .  $subdir)){
      // 不存在
      mkdir($this->_upload_path .  $subdir);

    }
    // 重命名
    // uniqid() 唯一的名字
    $upload_filename = uniqid($this->_prefix,true) . $ext;
    if(move_uploaded_file($tmp_file['tmp_name'], $this->_upload_path .  $subdir . $upload_filename)){
      // 成功后 ，返回文件名
      return $subdir . $upload_filename;
    }else{
      $this->_error = '移动失败';
      return false;
    }

  }

  // 多文件上传
  public function uploadList($tmp_file_list){
    $tmp_file=array();
    // 遍历
    foreach($tmp_file_list['error'] as $key=>$value){
      // 利用key 获取五个属性
      $tmp_file['name'] = $tmp_file_list['name'][$key];
      $tmp_file['type'] = $tmp_file_list['type'][$key];
      $tmp_file['tmp_name'] = $tmp_file_list['tmp_name'][$key];
      $tmp_file['error'] = $tmp_file_list['error'][$key];
      $tmp_file['size'] = $tmp_file_list['size'][$key];

    }
  }
}