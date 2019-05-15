<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>函数应用</title>
</head>
<body>
  

  <?php

    // 高效素数

    function is_primer($n){

      for($i=2;$i<= pow($n,0.5);$i++){
        if($n % $i == 0){ //正要发现有一个整除就false
          return false;
        }
      }
      return true;
    }
    // 求200内的素数
    // for($i=2;$i<=200;$i++){
    //   if(is_primer($i)){
    //     echo $i . " ";
    //   }
    // }
    // $t = microtime(true);

    // echo $t;


    // 求两个数的最大公约数和最小公倍数
// 公约数
    function gus($m,$n){
      $min = $m<$n? $m:$n; //循环小数就可以了
     
      $max = 1; //初始化最大公越数
      for($i=1;$i<= $min  ;$i++){
     
        if($m % $i == 0 && $n % $i == 0){
          $max =$i;
        }
      }
     return $max;
    }
    // 优化
    function gus2($m,$n){
      $min= $m<$n? $m:$n; //循环小数就可以了
      for($i = $min;$i>=1;$i--){
        if($m % $i == 0 && $n % $i == 0){
          return $i; //从打大小找， 找到第一个就是
        }
      }

    }
    // echo  gus2(24,36);
    // 公倍数
    function gbs($m,$n){
      $max= $m>$n? $m:$n; //找到较大的 

      for($i = $max;$i>0;$i+=$max){
        if($i%$m == 0 &&  $i % $n == 0){
          return $i; //
        }
        // return  ??;必然能找到，不需要写
      }
    }
    // echo  gbs(24,36);
    // 优化

    function gbs2($m,$n){
      return $m*$n/gus2($m,$n);
    }
    // echo  gbs2(24,36);

    // 写一个函数，让输入的参数串联起来，第一个是创联符

    function chuanlian(){
      $arr = func_get_args(); //获取所有实参
      if($arr){
        $s1 = $arr[0]; //第一个参数

        $count = count($arr); //也可以是 func_num_args();
        if($count>=2){
          $result = $arr[1]; //先去的第一项数据
          for($i=2;$i<$count;$i++){ // 遍历连接第二项数据往后
          $result .= $s1 . $arr[$i]; 
          }
          return $result;
          }
        
      }
     
    }
   echo chuanlian('-',2,2);

  //  递归地推求阶乘

  $n =6;
  $jc =1;

  for($i=2;$i<=$n;$i++){
    $res = $jc * $i; //求得当前i 的阶乘
    $jc = $res; //把当前项的值赋给$jc,目的是为了下一项的时候当做前一项使用



  }
  // echo $res;

  // 数列 1,2,3,6,9,18，...，用递归求第20项的值是多少


  function  shulie($n){
    if($n == 1){
      return 1;
    }
    if($n == 2){
      return 2;
    }
    return shulie($n-2)*3;
  };
  echo shulie(5);
  ?>
</body>
</html>