
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


// class A {
//     var $a = 123;
// }


// $o1 = new A();
// // echo "o中的a=" . $o1->a;
// $o2 = clone $o1;
// $o1->a =10;
// var_dump($o1);

// echo '<br>';

// var_dump($o2); //只能克隆对象中的 “非对象非资源” 数据：



class A {
    var $a1 =1 ;
    var $b1;
    function __construct(){
        $this->b1 = new B();   //new 时候 b1中存储的是对象
    }
   
}
class B {
    
    public $b1= 2;

}
$o1 = new A();
$o2 = clone $o1;
$o1->a1= 10;
$o1->b1->b2= 20; //修改ol对象中的b1 属性的数据
var_dump($o1);

echo '<br>';

var_dump($o2); //对象中属性存储的对象类型，克隆的就不完全
?>
    
</body>
</html>