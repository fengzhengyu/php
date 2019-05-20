<?php
    // 类名习惯使用 跟文件名相似的名字
    // 定义一个类，该类用于连接数据库
    // 并连接数据库后返回资源（或失败终止）

    // 优化
    class MysqlDB{
        public $host;
        public $port;
        public $username;
        public $password;
        public $charset;
        public $dbname;
       
        // 连接结果
        static $link;

        // 构造函数
        public function __construct($config){
            // 初始化数据
            $this->host= isset($config['host'])?$config['host']:'localhost'; //iset()是否存在
            $this->port= isset($config['port'])?$config['port']:'3306'; 
            $this->username= isset($config['username'])?$config['username']:'root'; 
            $this->password= isset($config['password'])?$config['password']:'root'; 
            $this->charset= isset($config['charset'])?$config['charset']:'utf8'; 
            $this->dbname= isset($config['dbname'])?$config['dbname']:'shop'; 
            // 连接数据库
            self::$link =$this->connect();
            // 设定连接编码
            $this->setCharset();
            // 选定数据库
            $this->selectDb();

        }
        // 连接数据库
        public function connect(){
            $link= mysql_connect(
               "$this->host:$this->port",
               "$this->username",
               "$this->password"
            ) or die('连接数据库失败！');

            return $link;
        }

        public function setCharset(){
            mysql_set_charset("$this->charset", self::$link);
        }

        public function selectDb(){
            mysql_select_db("$this->dbname", self::$link);
        }


    }

    // 
    $config = array(
        'host'=> 'localhost',
        'port'=> '3306',
        'username'=> 'root',
        'password'=> 'root',
        'charset'=> 'utf8',
        'dbname'=> 'shop',
    );
    $link = new MysqlDB($config);




?>