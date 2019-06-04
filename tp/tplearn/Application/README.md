
# ThinkPHP 路由
    http://网址/文件入口(index.php)/分组（平台）/控制器/方法(动作)
    如： http://localhost/tplearn/index.php/home/index/index

    'URL_MODEL'=> 1, //也就是 :U('Admin/index') 默认是 1 
    四种模式 
    0 普通模式       http://localhost/tplearn/index.php?m=home&c=index&a=add
    1 pathinfo模式   http://localhost/tplearn/index.php/home/index/add
    2 rewrite模式
    3 兼容模式       http://localhost/tplearn/index.php?s=/home/index/add
    
# 定义和调用TP模板
    规则： 一个控制器对应一个文件夹，一个方法对应一个文件
    所有模板都要放在view文件夹

    调用：
    public function add(){
        $this->display();//当前控制器的当前方法
        $this->display('show');//当前控制器的show方法
        $this->display('Goods/inex');//goods控制器的index方法
        $this->display('./Application/Public/test.html/');//模板页面的绝对地址
    }
# 获取ThinlPHP系统常量
    var_dump(get_defined_constants(true));
    __SELF__