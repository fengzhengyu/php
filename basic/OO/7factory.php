<?php
//    工厂模式

    class factory{
        // $className 表示实例，对象
        static function  getInstance($className){
            // 如果文件存在,就穿
            if(file_exists('./class/'.$className . '.class.php')){
                $obj = new $className();
                return $obj;
            }else{
                return false;
            }
            
        }

    }
    $obj1 = factory::getInstance("A"); //获取类A的一个对象

    var_dump(  $obj1);
?>