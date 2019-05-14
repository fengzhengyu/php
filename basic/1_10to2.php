<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>进制转换</title>
</head>
<body>
  
  <?php
    if($_POST){
      $n1 = (int)$_POST['n1'];
      
      $trans = $_POST['trans'];
      if($trans == "1"){
        $n2 = decbin($n1);
      }else if($trans == "2"){
        $n2 = decoct($n1);
        
      }else if($trans == "3"){
        $n2 = dechex($n1);
        
      }else if($trans == "4"){
        $n2 = bindec($n1);
        
      }else if($trans == "5"){
        $n2 = octdec($n1);
        
      }else if($trans == "6"){
        $n2 =hexdec($n1);
        
      }
    }
  // chr() 可获得编码为N的字符（32-126）
  
  ?>


  <form action="" method="post">

    <input type="text" name="n1" id="">
    <select name="trans" id="">
      <option value="1">10to2</option>
      <option value="2">10to8</option>
      <option value="3">10to16</option>
      <option value="4">2to10</option>
      <option value="5">2to8</option>
      <option value="6">2to16</option>
    </select>
    <input type="submit" name="submit1" value="转换">
    <input type="text" name="n2" id=""  value="<?php echo $n2?$n2:'';?>">


  </form>
</body>
</html>