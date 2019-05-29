<?php

$path ='F:\work\php\basic\test\demo';
  // $result = mkdir($path);
  // var_dump($result); //没有文件 false

  // $result = mkdir($path,0644,true);
  // var_dump($result); //true  递归创建


  // $result = rmdir($path);
  // var_dump($result); //true  删除的路径的最后一个 仅仅可以删除空目录

  // $path_from ='./path/to';
  // $path_to ='./aaa';
  // $result = rename($path_from,$path_to); //把to目录 该成 当前下的aaa 目录

  // $path =__DIR__;
  // $dir_handle = opendir($path);

  // var_dump(  $dir_handle); //resource(3) of type (stream)

  // while($file= readdir($dir_handle)){
  //   if($file == '.' || $file== '..')continue;
  //   echo $file.'<br>';
  // }
  // closedir($dir_handle); //资源型数据 用完一定要关闭
// 以上只能读 一级纹路


// 递归读多级目录

  // 递归点： 如果子目录为目录则递归
  // 出口： 如果目录里没有目录，则退出



  function readDirs($path){
    $dir_handle = opendir($path);

    while(false !==$file= readdir($dir_handle)){
      if($file == '.' || $file== '..')continue;

      // 输出文件
      echo $file.'<br>';
     if(is_dir($path.'/'.$file)){
      readDirs($path.'/'.$file);
     }
    }
    closedir($dir_handle);
  }
  readDirs($path);