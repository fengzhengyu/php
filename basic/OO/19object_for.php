
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


class A
{
    var $a1 = 1;
    protected $a2 = 2;
    private $a3 = 3;
    function fetchAll(){
        foreach ($this as $key => $value) {
            echo "<br>属性$key = $value"; //$key 只能访问 public 的属性
        }
    }
    // arr 参数 存储要取得的属性名的数组
    function fetchSome($arr){
        foreach ($this as $key => $value) {
            // 数组中是否有该属性
            if(in_array($key,$arr)){
                echo "<br>属性$key = $value"; //$key 只能访问 public 的属性
            }
           
        }
    }

}

$o1 = new A();
$o1->fetchAll(); //在内部写个方法遍历，可以得到
echo "<hr>"; 
$o1-> fetchSome(array('a1','a2'))

// foreach ($o1 as $key => $value) {
//     echo "<br>属性$key = $value"; //外面遍历 只能访问 public 的属性
// }
?>
    
</body>
</html>