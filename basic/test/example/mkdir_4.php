<?php
//转换编码 不好使 待研究
  $path ='F:\work\php\basic\test\demo';
  
  function readDirsNested($path){
    $nested = array(); //存储当前目录下的子目录
    $dir_handle = opendir($path);
    while(false !== $file= readdir($dir_handle)){
      if($file == '.' || $file== '..')continue;
      // 创建当前文件信息
      $fileinfo = array();
      $fileinfo['filename'] = $file;
      // $fileinfo['filename'] = iconv('gbk','utf-8', $file); //转换编码 不好使 待研究
  
      if(is_dir($path.'/'.$file)){
        //是目录
        $fileinfo['type'] = 'dir';
        $func_name = __FUNCTION__; //函数名自己

        $fileinfo['nested'] = $func_name($path.'/'.$file);  //是目录放进文件信息的nested 数组
      }else{
        // 是文件
        $fileinfo['type'] = 'file';
      }

      // 存入nested数组内
      $nested[] =   $fileinfo;
    }

    closedir($dir_handle);
    return $nested;
   
  }
  var_dump(readDirsNested($path));