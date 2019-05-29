<?php
  $path ='F:\work\php\basic\test\demo9';
  $n =0;

  // 递归删除
  function removeDirs($path,&$num){
    //惊天属性 记录return多少次
    ++$num;


    $dir_handle = opendir($path);

    while(false !==$file= readdir($dir_handle)){
      if($file == '.' || $file== '..')continue;

      //是目录
     if(is_dir($path.'/'.$file)){
       $func_name =__FUNCTION__;
      //  接着打开目录
       $func_name($path.'/'.$file,$num);
     }else{
      //  是文件
      // 删除
      unlink($path.'/'.$file);
     }
    }
    closedir($dir_handle);
   
    return rmdir($path);  // 删除完文件 删除目录
  }
  $result = removeDirs($path,$n);
  echo $n;

  var_dump($result);