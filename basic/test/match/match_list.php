<?php 
  // 比赛列表

  header('Content-Type: text/html; charset=utf-8');

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
  // var_dump($result)
?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>比赛列表</title>
  </head>
  <body>

      <table>
        <tr>
        <th>球队一</th>
        <th>球队比分</th>
        <th>球队二</th>
        <th>比赛时间</th>
        </tr>
        <?php foreach($match_list as $row) :?>
          <tr>
            <td><?php echo $row['t1_name'];?></td>
            <td><?php echo $row['t1_score'];?></td>
            <td><?php echo $row['t2_score'];?></td>
            <td><?php echo $row['t2_name'];?></td>
            <td><?php echo date('Y-m-d H:i', $row['m_time']);?></td>
          
          </tr>
         <?php endforeach?>
      
      </table>
  </body>
  </html>