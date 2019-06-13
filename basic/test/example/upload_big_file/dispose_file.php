<?php

header('Content-Type:text/html;charset=utf-8;');

if($_FILES['file']['error']>0){
  die('上传有问题！');
}

$path = './upload/'; //上传路径
$name = $_FILES['file']['name']; //上传名字
$name = iconv('UTF-8','gb2312',$name); //防止上传中文名出现乱码
if(move_uploaded_file($_FILES['file']['tmp_name'],$path.$name)){
  echo 'success';
}else{
  echo 'error';
}

