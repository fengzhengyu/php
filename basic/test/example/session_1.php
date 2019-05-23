<?php

require './usersession.php' ;
session_start();

$_SESSION['fz_name'] ='fengzheng';
$_SESSION['fz_age'] = 18;
var_dump($_SESSION['fz_name']);