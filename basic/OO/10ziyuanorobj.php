
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
//       $link = mysql_connect('localhost','root','root'); //得到一个连接数据库 资源
    $link = mysql_connect('localhost','root','root');
    // 资源理解： 一个外部本来就有的“对象” （数据）
    // 程序中，该资源变量只是一个“指向”该对象（数据）的标识符
    mysql_select_db('shop');
    $result = mysql_query('select * from product_type');
    var_dump( $result );
    // var_dump($link);//resource(3) of type (mysql link)
    // class A{

    // }
    // $o = new A();
    // // 对象是我们通常代码完整的创造出来 的
    // var_dump($o); //object(A)#1 (0) { }

?>
    
</body>
</html>