<?php 
  // 比赛列表

  header('Content-Type: text/html; charset=utf-8');

  // 载入负责处理数据的 model
  
  require './match_model.php';
  //载入负责显示的html
  require './template/match_view.html';

?>