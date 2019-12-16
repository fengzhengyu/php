<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  
  <?php
  echo '2000-2100年之间的闰年：';
  function  is_runnian($year){
    if($year %4 == 0 && $year % 100 !=0 || $year % 400 == 0){
      return true;
    }else{
      return false;
    }
  }
  
  for($i = 2000;$i <=2100; $i ++){
    if(is_runnian($i)){
      echo  "$i, ";
    }
  }
  
  echo '<br>';
  echo '<br>';
  echo '函数的传值：';
  function f1($p1,$p2){ // function f1($p1,&$p2) 引用传递  $p2 变 v2变
    $p1++;
    $p2++;
    $result = $p1+$p2;
    return $result;
  }
  $v1= 10;
  $v2 = 20;
  $s = f1($v1,$v2);
  echo "<br>s=$s,v1=$v1,v2=$v2";

  //  注意  只有变量才可以引用传递，引用参数的形参 必须对应实参变量 不能使用实参数据
  echo '<br>';
  echo '<br>';


  date_default_timezone_set('PRC');
  echo '时间函数time' . time();
  echo '<br>';

  echo '时间函数microtime' .microtime(true);
  echo '<br>';
  echo '时间函数microtime' .microtime(false);
  echo '<br>';
  echo '时间函数mktime' . mktime(10,8,5,12,09,2019); //时分秒月日年
  echo '<br>';
  echo '时间函数date' . date('Y-m-d H:i:s');
  echo '<br>';
  echo '时间函数idate' . idate("Y");
  echo '<br>';
  echo '时间函数strtotime' . strtotime("2019-12-09");  //将一个字符串转换成时间值

  echo '<br>';
  function testvar($x){
    // echo $n1; //报错 局部变量不能引用全局变量 
    // $GLOBALS[] 获取全局变量 
    //  global 在函数中定义全局变量， 相当于变量被引用了
    echo $x;
    

    $a =1;

    $v = $x*$x;

    return $v;

  }
  $n1= 10;
  $result2 = testvar($n1);
  echo '<br>';
  echo   $result2;



  $str1 = 'abc中英混合'; //一个中文汉字占三个字节
  echo '<br>';
  echo strlen($str1);
  echo '<br>';
 
  echo  '字符串长度：'.mb_strlen($str1);
  echo '<br>';
  $str2 = '   abc中英混合    ';
  echo '字符串去空白：'.trim($str1);
  echo '<br>';
  $str3 = 'hello world';
  echo '填充字符串的长度: '.str_pad($str3,20,'.');//用点点 补充不足
  echo '<br>';
  $arr = ['ab','cs',12,35];
  $str4 = implode('-',$arr);
  $str5 = join('-',$arr);
  echo '将数组连接成字符串implode：' .$str4;
  echo '<br>';
  echo '将数组连接成字符串join：' .$str5;
  echo '<br>';
  $str6 = 'ab-cd-7-3.5';
  $arr1 = explode('-',$str6);
  echo '按字符串指定符号分为数组：';
  var_dump($arr1);

  echo '<br>';
  $str7 = 'ab-cd-7-3.5';
  echo '将一个字符串按指定的长度分割为一个数组';
  echo '<pre>';
  $arr2 = str_split($str7,3);
  var_dump($arr2);
  echo '</pre>';
  echo '<br>';
  echo '字符串截取  substr: ' .substr('abcdefg',3);
  echo '<br>';

  echo '字符串截取abc123.txt  strstr: ' .strstr('abc123.txt','.') .' 获取首次起 到末尾的字符串'; //
  echo '<br>';

  echo '字符串截取abc.12.3.txt  strchr: ' .strchr('abc.12.3.txt','.');
  echo '<br>';

  echo '字符长度abc.12.3.txt  strpos: ' .strpos('abc.12.3.txt','.') . ' 首次出现的下标位置';
  echo '<br>';
  echo '字符长度abc.12.3.txt  strrpos: ' .strrpos('abc.12.3.txt','.') . ' 最后一下出现的下标位置';
  echo '<br>';
  echo '字符串转换SDSF -》： ' . strtolower('SDSF') . ' //将字串转换成小写';
  echo '<br>';
  echo 'asdsdsd -》：' . strtoupper('asdsdsd') . ' //将字串转换成大写';
  echo '<br>';
  echo 'SFSDF -》：' . lcfirst('SFSDF') . ' //首字母换成小写';
  echo '<br>';
  echo 'asdsdsd -》：' . ucfirst('asdsdsd') . ' //首字母换成大写';
  echo '<br>';
  echo 'hello world !: '. ucwords('hello world !'). ' //所有单词 首字母换成大写';
  echo '<br>';
  echo '特殊字符处理： nl2br：将换行符转换为”<br />”标签字符';
  echo '<br>';
  echo 'addslashes： 将一个字符串中的以下几个字符使用反斜杠进行转义：\	‘	“ ';
  echo '<br>';
  echo 'htmlspecialchars：将html中的特殊字符转换为html实体字符 ';
  echo '<br>';
  echo 'htmlspecialchars_decode：将html实体字符，转换回原本的字符 ';


  //练习  打印所有文件中的图片文件：  
  $files = array('abc.gif','ab.c2.txt','dir1/a.PNG','file1.JPG','gif动画教程.doc');
  $length = count($files);
  for($i=0;$i<$length;$i++){
    $suffix = strrchr($files[$i],'.');
    $suffix = substr($suffix,1);
    $suffix = strtolower($suffix);
    if( $suffix == 'png' || $suffix == 'jpg' ||$suffix == 'gif'){
      echo "<br> $files[$i]";
    }
  }
  echo '<br>';
  echo '<br>数组：';
  $a1 = [1,3.4,true,'abc'];
  $a2 = array(1,3.5,true);
  $a3 = ['a'=>5,'b'=>1.2,5=>true,3=>'abd'];
  $a4 = array(
    'host'=> 'localhost',
    'db'=> 'test',
    'user'=> 'root',
    'padd'=>'123'
  );
  echo '<pre>';
 
  var_dump($a2);
  var_dump($a1);
  var_dump($a3);
  echo '</pre>';


  
  



  ?>
</body>
</html>