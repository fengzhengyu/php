<?php

  return array(
    'db'    => array(//数据库信息组
      'host'        => 'localhost',
      'port'        => '3306',
      'username'    => 'root',
      'password'    => 'root',
      'charset'     => 'utf8',
      'dbname'      => 'demo7'
    ),
    'app'   => array( //应用程序组
      'default_platform' => 'admin',

    ),
    'admin'   => array( //后台组
      'default_controller' => 'Manage',
      'default_action' => 'index',
    ),
    'front'   => array( //前台组
  
    ),


  );