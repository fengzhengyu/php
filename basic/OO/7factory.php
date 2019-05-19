<?php
//    工厂模式

    class factory{
        // $className 表示实例，对象
        static function  getInstance($className){
            $obj = new $className();
            return $obj;
        }

    }
    $obj1 = factory::getInstance("A"); //获取类A的一个对象


?>