<?php
// 使用自定义session 机制
require './usersession.php' ;
session_start();

var_dump($_SESSION);