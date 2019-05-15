<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>素数</title>
</head>
<body>
  
  <?php
    // 输入一个数字，判断是否是一个素数，如果是输出是，反之输出不是

    // 从头照到尾
    // $n = 10000;
    // $c = 0;
    // for($i=1;$i<=$n;$i++){  //$n/2 
    //   if($n % $i == 0){
    //   // 只有除1 和本身的 数据 那么$c就是2次
    //     $c++;  //计数器思想
       
    //   }
    // }
    // if($c == 2){
    //   echo "{$n}是素数";
    // }else{
    //   echo "{$n}不是素数";
    // }




    // 方法二 
    // 减少for循环次数  //$n/2  只要找一半的数 只有一个可以整除，那么就是素数
    // for($i=1;$i<=$n/2;$i++){  
    //   if($n % $i == 0){
    //     echo $n.$i.'<br>';
    //   // 只有除1 和本身的 数据 那么$c就是2次
    //     $c++;  //计数器思想
       
    //   }
    // }
    // if($c == 1){
    //   echo "{$n}是素数";
    // }else{
    //   echo "{$n}不是素数";
    // }



  //方法三  给$n 开根号
    // $flag = false;
    // for($i=2;$i<$n;$i++){  //如果能被2整除
    //   if($n % $i == 0){
    //     $flag = true;
    //     break;
    //   }
    // }
    // if($flag){
    //   echo "数字最小被{$i}整除，不是素数";
    // }else{
     
    //   echo "{$n}是素数";
    // }


    // function is_ss($n)
    // {
    //  for($i=2;$i<$n;$i++){
  
    //   if($i>pow($n,0.5)){
    //     echo $i.  pow($n,0.5).'<br>';
    //     // echo "$n &nbsp; ";
    //     break;
    //   }
    //   if($n%2 ==0){
    //     break;
    //   }
    //  }
    // }
    // is_ss(5);

    // for($m=1;$m<=4;$m++){
    //   is_ss($m);
    // }


    // 最优方法
    function is_primer($n)
    {
      for($i=2;$i<= sqrt($n);$i++){
        if($n %$i == 0){
          return false;
        }
      }
      return true;
    }
    if( is_primer(7)){
      echo "是素数";
    }


    // 一组数的最小奇数

    $ary = array(3,5,8,11,7,6);
    foreach($ary as $val){
      if($val %2 == 1){
        $ary2[]= $val;
      }
    }
    if($ary2){
      $min = min($ary2);
      echo '最小奇数是'.$min;
    }else{
      echo '没有奇数';
    }
  ?>

</body>
</html>