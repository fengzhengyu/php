<?php
  $path ='F:\work\php\basic\test\demo8';


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
    // closedir($dir_handle);
  }
  readDirsTree($path);

  // 嵌套展示
  // 
  // 
  // 