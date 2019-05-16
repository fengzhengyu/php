<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>数组应用</title>
</head>
<body>
  

  <?php
// 输出n 行杨辉三角（n可以任意给定）
    //  规律：
    //  每一行的第一个和最后一个数字都是1
    //  其余的每个数字都是前一行的当前列与前一行的前一列的数字之和
    //  即 头顶和左肩数字之和
    //  提示：可以使用二维数组
  $n = 4;
  echo "<pre>";
  for($i =1;$i<=$n;$i++)  {

    for($k=1;$k<=$i;$k++){
      if($k==1 || $k == $i){ //每一行的第一个最后一个
        $arr[$i][$k] =1;
      }else{ //其他数据，根据规律找前一行数据
        // 例如i=3 
        //  $arr[3][2] = $arr[2][2] +$arr[2][1]; $arr[3][1]=1 ;$arr[3][3]=1
      
        $arr[$i][$k] =  $arr[$i-1][$k] + $arr[$i-1][$k-1];
        // 下面是新手考虑不周逻辑
        // if($i>1){ 
        //   // 如果不是第一行  ：一般规律
        //  $arr[$i][$k] =  $arr[$i-1][$k] + $arr[$i-1][$k-1];

        // }else{
        //   // 这里处理第一行 ，但最上面有 if($k==1 || $k == $i){，所以不徐判断 
        // }
      }

      echo $arr[$i][$k];  
      echo "\t";  
    }
    echo '<br/>';
  }
  echo "</pre>";


  /***
   * 猴子吃桃问题
   * 有一堆桃子，第一天吃了其中的一半，并再多吃一个，
   * 以后每天都吃其中的一半，再多吃一个
   * 当第十天的时候，想在吃（即还没吃），发现只有一个桃子了
   * 问： 最初公有多少个桃子？
   * 
   * 
   * 分析：
   *  天    数量
   *  10    1
   *  9     （1+1）*2 = 4
   *  8     （4+1）*2 = 10
   *  7     （10+1）*2 = 22
   *  .      .
   *  .      .
   *  .      .
   *  n       (第n+1天个数+1)*2
   * */ 

   function taozi ($n){
     if($n == 10) return 1;
    return (taozi($n+1)+1)*2;
   }
    // echo taozi(1);
  //  递推实现

   $yestoday =1;  //前一天的桃子数，已知第十天的1个
   for($i=9;$i>=1;--$i){
      $result = ($yestoday+1)*2;
      $yestoday = $result;
   }
   echo $result;
 



  ?>
</body>
</html>