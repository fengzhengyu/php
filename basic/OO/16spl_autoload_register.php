
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




spl_autoload_register('auto1');
spl_autoload_register('auto2');

function auto1($className){
    $file = "./library/" . $className .".class.php";
    if(file_exists($file)){
        require   $file;
      }
}
  

function auto2($className){
    $file = "./class/" . $className .".class.php";
    if(file_exists($file)){
        require   $file;
      }
  
}
// 依次加载，第一个找到就返回，找不到看第二个


$o = new A();
echo "o中的a=" . $o->a;
?>
    
</body>
</html>