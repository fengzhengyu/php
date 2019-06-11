
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
    echo __SELF__.'<BR>'; //当前文件地址
    echo __MODULE__ .'<BR>'; //当前分组
    echo __CONTROLLER__ .'<BR>'; //当前控制器
    echo __ACTION__ .'<BR>'; //当前文件地址
# 配置文件Common/Conf
    Application\Common\Conf\config.php      // 这个配置文件 只针对Application
    Application\Common\Common\              // 这是 Application应用程序下的公共函数目录
    ThinkPHP\Conf\                          //这个配置文件 对整个项目有效、
    ThinkPHP\Common                         // 这是 项目的公共函数目录

# 空方法 
    当方法找不到 也可以指向这个空操作
    public function _empty(){
    echo '非法操作！';
    }    
# 空控制器
    当系统找不到控制器，会定位到空控制上EmptyController     
# 语法 
    条件语句：
        <if condition="$name eq 1 "> value1
        <elseif condition="$name eq 2"/>value2
            <else /> value3
        </if>  
        表达式中的运算符：

            php             对应tp中的运算符       英文全称
            <                     lt              less then
            >                     gt              greater than
            ==                    eq              equal
            <=                    elt
            >=                    egt

    更多查看 thinkphp 开发手册文档 模板 -》内置标签

# 连接数据库

    // $Category = new \Home\Model\CategoryModel();
    // $Category = M('category'); //实例化父类model
    $Category = D('category'); // 相当于CategoryModel;
    D与M 没区别了

    对表的操作
    增加： M('表名')->add($data)
    删除： M('表名')->delete($data)
    更新： M('表名')->save($data)
    
    查询:  M('表名')->select();
    查询:  M('表名')->find(); 只取一条数据
# 自定义工具类
    在应用程序目录下（application）新建components 文件夹 /工具类文件
    引入  namespace Components 。php   new \Components\Page();

# RBAC 基于角色的访问控制（role based access control）

    早期权限
        编号   管理员   密码   等级 
        1     Tom      123     0
        2     Berry    000     1
        3     ketty    456     2
        以上方法 用于小网站 管理员少的 
    RBAC
        核心技术点就是表的设置

    不同角色显示不同的权限
    1 在登录成功后，把用户的 id 保存到会话中
        
