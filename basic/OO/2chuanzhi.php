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
    // 定义一个类

    class P {
      // 类中的属性
      var $v1 = 10;
     
    }

    $p1 = new P();
    $p2 = $p1;  //值传递
    $p3 = new P();
    $p1->v1 = 20;
    echo "<br>p1->v1为：" . $p1->v1;
    echo "<br>p2->v1为：" . $p2->v1;
    echo "<br>p1的标识符：";
    var_dump($p1); //object(P)#1 (1) { ["v1"]=> int(10) }
    echo "<br> p2的标识符：";
    var_dump($p2); //object(P)#1 (1) { ["v1"]=> int(10) }
    echo "<br>p3的标识符：";
    var_dump($p3); //object(P)#2 (1) { ["v1"]=> int(10) }
    // 为什么都是20？
    // 跟js一样 对象是引用类型 引用的object(P)#1 (1) { ["v1"]=> int(20) }中的 ，对象赋值，改变一个另一个也变化
  
  ?>
  
</body>
</html>