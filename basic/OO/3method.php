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

        class Person {
            public $x= 1;
            public $y= 1;
            public $PI = 3.14;
            public $name= '';
            public $age = 18;
            function getxiebian($a,$b){
                $v = $a*$a + $b*$b ;

                return  pow($v,0.5);

            }
            function say(){
                // $this 用法
                echo  '<br>我的名字是' .$this->name;
                echo  '<br>我今年' .$this->age .'岁';

            }
        }
        $p1 = new Person();
        $xieb = $p1->getxiebian(3,4);
        echo  $xieb;

        $p2 = new Person();
        $p2->name = '张三';
        $p2->age = 20;
        $p2->say();

        $p3 = new Person();
        $p3->name = '李四';
        $p3->age = 22;
        $p3->say();


    
    
    
    
    
    
    ?>
    
</body>
</html>