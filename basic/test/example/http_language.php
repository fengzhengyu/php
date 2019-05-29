<?php

  header('Content-Type:text/html;charset=utf8;');
  $_LANG['HELLO'] = 'hello';
  $browser_arr =array('zh','en','js');
  
  $browser_lang = $_SERVER['HTTP_ACCEPT_LANGUAGE']; //服务器支持 语言
  $browser_lang_list = explode(',',$browser_lang);
  // var_dump($browser_lang_list);



  echo '<pre>';
  var_dump($_SERVER);
  echo $_LANG['HELLO'] ,$_GET['name'];