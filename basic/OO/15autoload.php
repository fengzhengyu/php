
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
//    autoload 自动加载
// 这个函数中不是程序中调用，而是需要类的时候 自动调用
// 此时回传一个实参进来，是所需要类的类型
function __autoload($className){
    require "./library/" . $className .".class.php";
}
$o = new A();
echo "o中的a=" . $o->a;
?>
    
</body>
</html>