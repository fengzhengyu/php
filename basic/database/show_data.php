<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>查看数据库表的数据</title>
</head>
<body>
<?php
    mysql_connect('localhost','root','root');
    mysql_set_charset('utf8');

    $db = $_GET['db']; //获取数据库名
    $tab =$_GET['tab']; //获取表名
    mysql_select_db($db); //选择数据库

    $sql = "select * from  $tab";
    $result = mysql_query($sql ); //执行SQL 语句  查看所有数据

    if($result == false){
      echo '执行失败'.mysql_error();
    }else{
      $fieldCount = mysql_num_fields($result); //获取集合列数
      echo '<table border="1">';
        echo '<tr>';
        for($i=0;$i<$fieldCount;$i++){
          $fieldName = mysql_field_name($result,$i); //获取第i个列名
          echo '<th>'.$fieldName.'</th>';
        }
        echo '</tr>';
     
        while($rec = mysql_fetch_assoc($result)){
          echo '<tr>';
          for($i=0;$i<$fieldCount;$i++){
            $fieldName = mysql_field_name($result,$i); //获取第i个列名
            echo '<td>'.$rec[$fieldName].'</td>';
           
          }
          echo '</tr>';
        }
       
      echo '</table>';
    }

  
  ?>
</body>
</html>