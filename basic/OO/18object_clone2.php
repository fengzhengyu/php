
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
class B {
    
    public $b2= 2;

}

class A {
    var $a1 =1 ;
    var $b1;
    function __construct(){
        $this->b1 = new B();   //new 时候 b1中存储的是对象
    }
    function __clone(){
        $this->b1 = clone $this->b1;
    }
}

$o1 = new A();
$o2 = clone $o1;
$o1->a1= 10;
$o1->b1->b2= 20; //修改ol对象中的b1 属性的数据
var_dump($o1);

echo '<br>';

var_dump($o2); 
?>
    
</body>
</html>