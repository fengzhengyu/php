<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>for 循环应用</title>
</head>
<body>
  
  <?php
    
    echo '<br>';
    $n = 4;

    for($i=1; $i <= $n;$i++){ //确定输出的行数
      for($k=1;$k <=$i;$k++){  //确定一行要输出的个数
        echo '*';
      }
      echo '<br>'; //循环一次换行一次
    }
// 
    echo '<br>';
    for($i=1; $i <= $n;$i++){ //确定输出的行数
      for($k=1;$k <= 2 *$i-1 ;$k++){  //确定一行要输出的个数
        echo '*';
      }
      echo '<br>'; 
    }
    for($i=1; $i <= $n;$i++){ 
      // 先输出若干个空格
      for($m =1;$m<=$n-$i;$m++){
        echo '&nbsp;';
      }

      for($k=1;$k <= 2 *$i-1 ;$k++){  
        echo '*';
      }
      echo '<br>'; //
    }
//==================================================
    echo '<br>';
    
    for($i=1; $i <= $n;$i++){ 
      // 先输出若干个空格
      for($m =1;$m<=$n-$i;$m++){
        echo '&nbsp;';
      }

      for($k=1;$k <= 2 *$i-1 ;$k++){ 
        // 如果等于第一个或者最后一个
        if($k==1 ||  $k == 2 *$i-1){
          echo '*';
        }else{
          echo '&nbsp;';
        }
       
      }
      echo '<br>'; 
    }
    //==================================================
    echo '<br>';
    
    for($i=1; $i <= $n;++$i){ 
      // 先输出若干个空格
      for($m =1;$m<=$n-$i;++$m){
        echo '&nbsp;';
      }

      for($k=1;$k <= 2 *$i-1 ;++$k){ 
        // 如果是最后一行，都输**
        if($i== $n){
          echo '*';
        }else{
           // 如果等于第一个或者最后一个
          if($k == 1 ||  $k == 2 *$i-1){
            echo "*";
          }else{
            echo "&nbsp;";
          }
        }
       
       
      }
      echo '<br>'; 
    }
  
  ?>

</body>
</html>