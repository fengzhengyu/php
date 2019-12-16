<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>双重for循环</title>
</head>
<body>
  
<?php
  // 
echo '输出100以内能被3整除不能被5整除的偶数:<br/>';
for ($i = 1; $i <= 100; $i++) {
  if ($i % 3 == 0 && $i % 5 != 0 && $i % 2 == 0) {
    echo $i . ',';
  }
}
// 
echo '<br>';
echo '<br>';

echo '输出100以内能被3整除用三代替，被5整除的用五代替，同时被35整除用三五代替:<br/>';
for ($i = 1; $i <= 100; $i++) {
  if ($i % 3 == 0 && $i % 5 == 0) {
    echo '三五,';
  } else if ($i % 5 == 0) {
    echo '五,';
  } else if ($i % 3 == 0) {
    echo '三,';
  } else {
    echo "$i ,";
  }
}
echo '<br>';
echo '<br>';

for ($i = 1; $i <= 4; $i++) {
  echo '<br>' . $i . ' ';
  for ($n1 = 2; $n1 <= 7; $n1++) {
    echo $n1 . ' ';
  }
  echo '8;';
}
echo '<br>';
echo '<br>';

echo "<table border='1' width=400 height=100>";
$num = 0;
for ($i = 1; $i <= 4; $i++) {
  echo "<tr>";
  for ($k = 1; $k <= 6; $k++) {
    $num++;
    echo "<td>$num</td>";
  }
  echo "</tr>";
}
echo "</table>";

echo '<br>';
echo '<br>';
echo '九九乘法表：';

echo "<table border='1' width=700 height=200>";

for ($i = 1; $i <= 9; $i++) {
  echo "<tr>";
  for ($k = 1; $k <= $i; $k++) {

    echo "<td>{$k}x$i=" . $k * $i . "</td>";
  }
  echo "</tr>";
}
echo "</table>";

echo '<br>';
echo '<br>';
echo '百元百只鸡： 公鸡5元/只,母鸡三元/只,小鸡一元三只';

$count = 0;

// for($gongji=0;$gongji<=100; $gongji++){
//   for($muji=0;$muji<=100; $muji++){
//     for($xiaoji=0;$xiaoji<=100; $xiaoji++){
//       if($gongji+$muji+$xiaoji ==100 && $gongji*5+$muji*3 + $xiaoji/3 == 100){
//         echo "<br>公鸡: $gongji,母鸡: $muji, 小鸡：$xiaoji";
//       }
//       $count++;
//     }
//   }
// }
// echo "<br>运行的次数有： $count";


for ($gongji = 0; $gongji <= 100 / 5; $gongji++) {	
	//考虑母鸡的价格，以及，公鸡数量确定后所花掉的钱
  for ($muji = 0; $muji <= (100 - $gongji * 5) / 3; $muji++) {
		//小鸡数量无需“假设”，也就无需循环，而是可算出
		//for($xiaoji = 0; $xiaoji <= 100; $xiaoji++){
			//计算小鸡数量：
    $xiaoji = 100 - $gongji - $muji;
  
			//如果小鸡数量不为3的倍数，则无需往下计算了
    if ($xiaoji % 3 != 0) {
      continue;
    }
    ++$count;	//计数
    if ($gongji * 5 + $muji * 3 + $xiaoji / 3 == 100) {
      echo "<br />公鸡$gongji, 母鸡$muji, 小鸡$xiaoji";
    }
		//}
  }
}
echo "<br />总计运行{$count}次。";

echo '<br>';
echo '<br>';
$n = 5;

//n行n列
for ($i = 1; $i <= $n; $i++) {
  echo "<br>";
  for ($k = 1; $k <= $n; $k++) {
    echo '*';
  }
}
echo '<br>';
echo '<br>';
// /n行 有i列
for ($i = 1; $i <= $n; $i++) {
  echo "<br>";
  for ($k = 1; $k <= $i; $k++) {
    echo '*';
  }
}
// 
echo '<br>';
echo '<br>';
for ($i = 1; $i <= $n; $i++) {
  echo "<br>";
  for ($k = 1; $k <= $i * 2 - 1; $k++) {
    echo '*';
  }
}
echo '<br>';
echo '<br>';
for ($i = 1; $i <= $n; $i++) {
    // 先输出若干个空格
  for ($m = 1; $m <= $n - $i; $m++) {
    echo '&nbsp;';
  }

  for ($k = 1; $k <= $i * 2 - 1; $k++) {
    echo '*';
  }
  echo "<br>";
}


echo '<br>';
echo '<br>';

for($i = 1; $i <=10; $i++){
  // if($i % 3 == 0){
  //   continue;
  // }
  // if($i % 9 == 0){ //这不执行 因为摸3的时候跳过本次循环了
  //   break;
  // }
  if($i % 9 == 0){ //跳出循环
    break;
  }
  if($i % 3 == 0){
    continue;
  }
 
  echo "$i, ";
}
echo "<br>$i"; 

echo '<br>';
echo '<br>';



?>

</body>
</html>