
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
        public function __get($prop_name){
            if(isset($this->propArr[$prop_name])){
                return $this->propArr[$prop_name];
            }
            return '不存在属性'.$prop_name;

        }
        public function __set($prop_name,$values){
          
              $this->propArr[$prop_name] = $values;  
        }
        public function __isset($prop_name){
            if(isset($this->propArr[$prop_name])){
                return true;
            }
            return false;
            
        }
        public function __unset($prop_name){
            
            unset($this->propArr[$prop_name]);
        }
    }

    $o =new A();
    echo '<br> o的p1属性值为' . $o->p1;
    echo '<br> o的p2属性值为' . $o->p2;
    $o->p2 =2  ;
    echo '<br> o的p2属性值为' . $o->p2;
    $o->p2 =3  ;
    echo '<br> o的p2属性值为' . $o->p2;
?>
    
</body>
</html>