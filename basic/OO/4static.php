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
        class Obj {
            static $v = 10;

        }
        $test = Obj::$v;   //取得静态属性

        Obj::$v = 100;
        echo $test;
        echo Obj::$v;

        $c1 = new Obj();
        $c2 = new Obj();
        echo "<br> c1的中的静态属性v=" . $c1::$v;
        $c1::$v = 100; //修改了公共属性

        echo "<br> c1的中的静态属性v=" . $c2::$v;  //都修改了


        // 静态方法

        class C1 {
            public $name = 'abc';
            public $age = '';
            static  function sayhello(){
               
                echo "我的名字是" . $this->name; //Fatal error: Using $this when not in object context
                // 静态方法中不能使用  this
            }
            function f1(){
                echo  '静态犯法中调用了普通方法';
            }

        }
        $p1 = new C1();
        // $p1::sayhello(); //对象调用静态方法，也不能使用 this 

        // self 

        class  C2{
            public $name = 'sfsdf';
            static function getNew(){
                
                return  new self; //self 代表当前类  newself 就是当前类的一个对象
            }
           
        }

        $a1 = C2::getNew(); //通过S2的静态方法，得到该类的 的一个新对象

        // var_dump($a1);


        // 构造方法

        // 创建对象的时候给定特定的值
        class  C3 {
            public $name = 'sfsdf';
            function say(){
                
                echo "<br>我的名字是" . $this->name; 
            }
            function __construct($n){
                $this->name = $n;
            }
           
        }
        $a2 = new C3('礼包');
        $a2->say();



    
    
    ?>
    
</body>
</html>