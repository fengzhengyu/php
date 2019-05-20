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
// 
    
    class A{
      
    }
    $obj1 = new A(); 
    $obj1= $obj1; //此时还是一个对象

    $obj3 = new A(); //这时候才有第二个对象
    var_dump( $obj1, $obj1, $obj3); //
    echo "<br> 上面不能实现单例模式";
    //    单例模式

    class B{
        public $v =10;
        private static $instance ; //定义属于类的 静态属性
        private function __construct(){

        }
        public static function getNew(){
            // 如果本类中 $instance 没有数据，就创建对象
            if(!isset(B::$instance)){
                B::$instance = new self; //创建一个本类的实例
            }
            return B::$instance;

        }

    }
    // $c = new B(); //出错，因为构造方法私有

    $o = B::getNew();
    $o2 = B::getNew();
    var_dump( $o, $o2); // 一个对象 object(B)#3 (1) { ["v"]=> int(10) } 
?>
</body>
</html>