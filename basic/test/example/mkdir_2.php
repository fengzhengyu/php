<?php
  $path ='F:\work\php\basic\test\demo9';


// 递归读多级目录

  // 递归点： 如果子目录为目录则递归
  // 出口： 如果目录里没有目录，则退出

  // 树桩展示
  // 使用特定数量的缩进
  // 核心问题： 计算需要缩进的数量（  每递归一次 都会比上一次深）
  // 缩进级别： 与递归深度保持一致，每当执行一次递归，所找到的文件的缩进级别+1
  // 语法实现: 增加参数，记录表示当前的函数调用的深度级别，每当递归一次+1

  function readDirsTree($path,$deep=0){
    $dir_handle = opendir($path);

    while(false !== $file= readdir($dir_handle)){
      if($file == '.' || $file== '..')continue;

      // 输出文件
      // echo $deep,$file.'<br>';

       echo str_repeat('&nbsp;',$deep*4),$file.'<br>';

     if(is_dir($path.'/'.$file)){
        $func_name = __FUNCTION__; //函数名自己

        $func_name($path.'/'.$file,$deep+1); //++ 会导致初始值改变 。++有个赋值的效果
     }
    }
    closedir($dir_handle);
  }
  // readDirsTree($path);

  // 嵌套展示
  // 多维数组
  // 
  // 

  function readDirsNested($path){
    $nested = array(); //存储当前目录下的子目录
    $dir_handle = opendir($path);
    while(false !== $file= readdir($dir_handle)){
      if($file == '.' || $file== '..')continue;
      // 创建当前文件信息
      $fileinfo = array();
      // $fileinfo['filename'] = $file;
      $fileinfo['filename'] = iconv('gbk','utf8', $file); //转换编码
  
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
  // echo '<pre>';
  // print_r(readDirsNested($path));
  // $list = readDirsNested($path);

  // foreach($list as $first){
  //   echo $first['filename'] .'<br>';
  //   if($first['type'] == 'file') continue; //如果是文件跳过继续循环
  //   foreach($first['nested'] as $second){
  //     echo "&nbsp;&nbsp;" . $second['filename'].'<br>';

  //   }

  // }

  // 递归删除
  function removeDirs($path){
    // static $call_num = 0; //惊天属性 记录return多少次
    // ++$call_num;


    $dir_handle = opendir($path);

    while(false !==$file= readdir($dir_handle)){
      if($file == '.' || $file== '..')continue;

      //是目录
     if(is_dir($path.'/'.$file)){
       $func_name =__FUNCTION__;
      //  接着打开目录
       $func_name($path.'/'.$file);
     }else{
      //  是文件
      // 删除
      unlink($path.'/'.$file);
     }
    }
    closedir($dir_handle);
   
    return rmdir($path);  // 删除完文件 删除目录
  }
  $result = removeDirs($path);


  var_dump($result);