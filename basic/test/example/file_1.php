<?php
// 读文件
header('Content-Type:text/html;charset=utf8;');

$path = './aaa/a.txt';
// $result = file_get_contents($path );
// echo $result;
// 写文件
// $content = date('Y-m-d H:i:s');
// $result = file_put_contents($path ,$content);
// var_dump($result) ; //返回值 写入字节数int(19)
$mode = 'r';
$file_handle = fopen($path,$mode);
// var_dump($file_handle ); //resource(3) of type (stream)

// $len =6;
// $content = fread($file_handle,$len);
// var_dump($content); //一个汉字三个字节

// $len =24; //
// $content = fgets($file_handle,$len); 
// var_dump($content); //末尾空格会结束


// $content = fgetc($file_handle);
// echo  ($content);


// $content = fgetc($file_handle);
// echo  ($content);

fclose($file_handle);