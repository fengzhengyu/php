<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>查看所有数据库</title>
</head>
<body>
  <?php
    mysql_connect('localhost','root','root');
    mysql_set_charset('utf8');
    $sql = 'show databases';
    $result = mysql_query($sql );

    if($result == false){
      echo '执行失败';
    }else{
      $fieldCount = mysql_num_fields($result); //获取集合列数
      echo '<table border="1">';
        echo '<tr>';
        for($i=0;$i<$fieldCount;$i++){
          $fieldName = mysql_field_name($result,$i); //获取第i个列名
          echo '<td>'.$fieldName.'</td>';
        }
        echo '<td>操作</td>';
        echo '</tr>';
     
        while($rec = mysql_fetch_assoc($result)){
          echo '<tr>';
          for($i=0;$i<$fieldCount;$i++){
            $fieldName = mysql_field_name($result,$i); //获取第i个列名
            echo '<td>'.$rec[$fieldName].'</td>';
            echo '<td><a href="show_table.php?db='.$rec[$fieldName].'">查看表</a></td>';
          }
          echo '</tr>';
        }
       
      echo '</table>';
    }

  
  ?>
</body>
</html>