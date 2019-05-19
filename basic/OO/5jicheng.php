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

     class jizhuidongwu {
         public $prop1 = '有脊椎';
         function show1(){
             echo "<br>特征" . $this->prop1;
         }

     }

     class human extends jizhuidongwu{
        public $prop2 = '两只腿走路';
        function show2(){
            echo "<br>特征" . $this->prop2;
        }
     }
     $p= new human();

     $p->show1();
     $p->show2();

    
    
    
    
    
    
    ?>
    
</body>
</html>