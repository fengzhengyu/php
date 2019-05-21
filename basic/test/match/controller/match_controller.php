<?php 
  // 比赛列表

  header('Content-Type: text/html; charset=utf-8');

  // // 实例化响应模型类对象 model，调用某个方法，实现固定功能
  // require '../model/MatchModel.class.php';
  // $m_match = new MatchModel();

  // 通过工厂获得对象

  require '../model/Factory.class.php';
  $m_match = Factory::M('MatchModel');
  $m_match2 = Factory::M('MatchModel');
  // var_dump($m_match,$m_match2); //是一个对象
  $match_list = $m_match->getList();

  //载入负责显示的html
  require '../template/match_view.html';

?>