<?php
  // 通过数据库操作，将比赛列表需要的数据处理 
  require('./MysqlDB.class.php');
  $config = array(
    'host'=> 'localhost',
    'port'=> '3306',
    'username'=> 'root',
    'password'=> 'root',
    'charset'=> 'utf8',
    'dbname'=> 'match',
);
// dao -> database access object 数据库操作对象
  $dao = MysqlDB::getInstance($config);

  $sql = "select t1.t_name as t1_name,m.t1_score,m.t2_score,t2.t_name as t2_name, m.m_time from `match` as m  left join `team` as t1 ON m.t1_id = t1.t_id left join `team` as t2 ON m.t2_id = t2.t_id";

  // 获得对象
  $match_list = $dao->getAll($sql);


?>