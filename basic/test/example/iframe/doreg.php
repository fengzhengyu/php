<?php

  header('Content-Type:text/html;charset=utf-8;');


 $username =   $_GET['username'];
 $message = '';

 if($username == 'admin'){
   $message = '对不起，该用户名已被占用！';
 }else{
   $message = '恭喜你，该用户名可用！';
 }

//  在子页面写js代码

 echo ("<script type='text/javascript'> window.parent.document.getElementById('message').html = $message;</script>");
