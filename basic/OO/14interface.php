
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
//    interface  接口
interface flyAnimal{

    function fly();
}
  
class bird {
    public $wings = '2'; //两个翅膀
    
}

// 继承接口的特性 被称为 实现(implements) 
class maque extends bird implements flyAnimal{

    // Class maque contains 1 abstract method and must therefore be declared abstract or implement the remaining methods (flyAnimal::fly)
    // 类maque包含一个抽象方法，因此必须声明为抽象方法或实现其余方法(flyAnimal::fly)
    
    function fly(){
        echo "<br> 煽动{$this->wings} 个翅膀。在飞翔";
    }
}

$m1 = new maque();
$m1->fly();

class tuoniao extends bird {
    function run(){
        echo "<br> 鸵鸟油{$this->wings} 个翅膀，但在跑";
    }
}
$m2 = new tuoniao();
$m2->run();
?>
    
</body>
</html>