<?php
  // echo '<pre>';
  // // $_POST 只存 字符串，
  // var_dump($_POST); 
  //  var_dump($_FILES);
  //  move_uploaded_file($_FILES['file']['tmp_name'],'./demo.jpg');

  /**
   * 上传
   *@param $tmp_file 临时长传文件信息
   *@return string  返回成功的文件名 ，失败是false 
   */ 
  function upload($tmp_file){
    // 是否存在错误
    if($tmp_file['error'] !=0){
      echo '文件上传错误';
      return false;
    }
    // 大小
    $max_size = 1024*1024; //1M
    if($tmp_file['size']>$max_size){
      echo '文件大于1M';
      return false;
    }
    // 类型
    $type_map =array(
      '.png'=>array('image/png','image/x-png'),
      '.jpg'=>array('image/jpeg','image/pjpeg'),
      '.jpeg'=>array('image/jpeg','image/pjpeg'),
      '.gif'=>array('image/gif')
    );
    // 后缀 从原始文件名中提取 strrchr
    $allow_ext =array('.png','.jpg','.gif','.jpeg');
    $ext =  strtolower(strrchr($tmp_file['name'],'.')); //strtolower转换成小写
    if(!in_array($ext,$allow_ext)){
      echo '类型不合法';
      return false;
    }
    // MIME type元素
    $allow_mime_list=array();
    foreach($allow_ext as $value){
      $allow_mime_list  = array_merge($allow_mime_list,$type_map[$value]);
    }
    // 去重
    $allow_mime_list = array_unique( $allow_mime_list);

    // 获得真实文件类型
    // PHP 自己获取mime进行检查
    // $finfo = new finfo(FILEINFO_MIME_TYPE);
    // $mime_type = $finfo ->file($tmp_file['name']); //检测
    // echo $mime_type;
    
    if(!in_array($tmp_file['type'],$allow_mime_list)){
      echo '类型不合法';
      return false;
    }
    // 移动位置
    $upload_path = './';
    // 创建子目录
    $subdir = date('YmdH') .'/';
    if(!is_dir($upload_path .  $subdir)){
      // 不存在
      mkdir($upload_path .  $subdir);

    }
    // 重命名
    // uniqid() 唯一的名字
    $upload_filename = uniqid('logo',true) . $ext;
    if(move_uploaded_file($tmp_file['tmp_name'], $upload_path .  $subdir . $upload_filename)){
      // 成功后 ，返回文件名
      return $subdir . $upload_filename;
    }else{
      echo '移动失败';
      return false;
    }


  }

  function uploadList($tmp_file_list){
  
    // 遍历
    $arr = array();
    foreach($tmp_file_list['error'] as $key=>$value){
      // 利用key 获取五个属性
      $tmp_file=array();
      $tmp_file['name'] = $tmp_file_list['name'][$key];
      $tmp_file['type'] = $tmp_file_list['type'][$key];
      $tmp_file['tmp_name'] = $tmp_file_list['tmp_name'][$key];
      $tmp_file['error'] = $tmp_file_list['error'][$key];
      $tmp_file['size'] = $tmp_file_list['size'][$key];
      $arr[] = upload($tmp_file);
    }
    return $arr;
  }
    echo '<pre>';
 var_dump(uploadList($_FILES['pic'])) ;


//   $f = 'a.s.x.y.png';
//   echo strrchr( $f, '.');  //找最后一个点 .png
//   echo strchr( $f, '.');  //找第一个点 .png
//   echo strstr( $f, '.');   //找第一个点.s.x.y.png

//   echo __FILE__;  //当前文件路径
//   echo '<br>'.uniqid().'<br>';
//   echo '<br>'.uniqid('logo_').'<br>';
//   echo '<br>'.uniqid('logo_',true).'<br>';
// var_dump(pathinfo($f)); //数组包含各种信息