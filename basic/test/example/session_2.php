<?php
// 使用自定义session 机制

ini_set('session.gc_probability','1');
ini_set('session.gc_divisor','3');
require './usersession.php' ;

session_start();

$_SESSION['fz_name'] ='fengzheng';
$_SESSION['fz_age'] = 18;

// var_dump($_SESSION['fz_name']);