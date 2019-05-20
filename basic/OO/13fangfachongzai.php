
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
    class A{
        public $p1= 1;
        public $propArr = array();
        // 当使用对象调用一份不充在的方法，就会调用以下函数
        // $name就是调用的方法名
        //  $array 本就调用该方法使用的实参，都装入该数组
        public function __call($name,$array){
            
            if($name == '函数名'){

            }else  if($name == '函数名'){

            }


        }
    
    }

    $o =new A();
    $o->f1();
    $o->f2(10,20);
    echo '<br> o的f1方法为' . $o->p1;
  
?>
    
</body>
</html>