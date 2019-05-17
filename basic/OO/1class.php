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
    // 定义一个类

    class Obj {
      // 类中的属性
      var $name = '';
      var $age = 18;
      var $sex = '';

      // 类中的方法（就是函数）
      function f1(){
        echo '函数f1被调用';
      }

      // 类中有一些常量（类常量）
      const PI = 3.14;
    }

    // 该类创建好之后，只是一个死代码 （类似一个变量定义好了）
    // 创建该类的一个对象

    $person1 = new Obj(); //obj是类型


    // 使用对象
    $person1-> f1();  //调用该类的方法
    $person1->name= '张三'; //给属性赋值 不需加$ 
    $person1->sex= '男';
    // 
    $str = $person1->name;
    echo  $str . $person1::PI;


    /**
     * 原来（面向过程）的语法中： 我们的代码有以下几种
     * 定义变量
     * 定义函数
     * 使用变量（输出，赋值，等）
     * 使用函数
     * 流程控制 （if switch for while 等）
     * **/ 

    /**
     * 在面向对象中，则发生了变化
     * 1 定义类 定义类的语法中，只有3中代码
     *    1.1 定义属性  （变量）
     *    1.2 定义方法 （函数）
     *    1.3 定义常量
     *    
     * 2 创建类的对象：
     *     $person1 = new Obj(); 
     *     $person2 = new Obj(); 
     *    
     * 3 使用对象
     *   1.1 使用属性  $person1->name;
     *   1.2 使用方法  $person1-> f1();
     *   1.3 使用常量  $person1::PI;
     * **/ 
  
  ?>
  
</body>
</html>