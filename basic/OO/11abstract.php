
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
//   游戏中的“怪” 类 （抽象类）：

abstract class guai {
    protected $blood = 100;  //蓝 
    protected $distance = 30;  //开始发动攻击的距离
    protected abstract function attack(); //攻击行为（抽象的）
    // 这个类不能实例化，也就是不能做出怪的类
    // 但是它规定了下级类的一些特性信息
    // 其中有个特性行为，就是攻击


}
   
class snakeGuai extends guai{

    // 也就是重写父类
   function attack(){
        echo '<br>吐火攻击';
        $this->blood--;
        echo '<br>吐火攻击后蓝剩余'  . $this->blood;
   }
}
$snake = new  snakeGuai();
$snake->attack();
$snake->attack();
$snake->attack();
$snake->attack();
$snake->attack();

?>
    
</body>
</html>