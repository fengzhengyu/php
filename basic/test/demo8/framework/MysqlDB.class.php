
<?php
    // 类名习惯使用 跟文件名相似的名字
    // 定义一个类，该类用于连接数据库
    // 并连接数据库后返回资源（或失败终止）

    class MysqlDB{
        public $host;
        public $port;
        public $username;
        public $password;
        public $charset;
        public $dbname;
       
        //实例化的对象 （）
        private static $link;
        // 连接结果 (资源)
        private $resourc;

        
        // 单例模式
        public static function getInstance($config){
            if(!isset(self::$link)){
                self::$link = new self($config);

            }
            return self::$link;
        }
        // 构造函数 禁止 new 
        private function __construct($config){
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
        // 禁止clone
        private function _clone(){}
        // 连接数据库
        public function connect(){
            // 数据库；连接成功 返回的是资源
            $this->resourc= mysql_connect(
               "$this->host:$this->port",
               "$this->username",
               "$this->password"
            ) or die('连接数据库失败！');

    
        }

        public function setCharset(){
            mysql_set_charset("$this->charset", $this->resourc);
        }

        public function selectDb(){
            mysql_select_db("$this->dbname", $this->resourc);
        }
        
        /**
         * 功能： 执行最基本的 SQL 语句
         * 返回： 成功返回执行结果，失败，返回错误信息
         */

        public function query($sql){
           
            if(!$result = mysql_query($sql,$this->resourc)){
                echo '<br> 执行失败';
                echo '<br> 失败的SQL语句为' .$sql;
                echo '<br> 出错信息为' .mysql_error();
                echo '<br> 错误代号为' .mysql_errno();
                die();
            }
            return $result;
        }
         /**
         * 功能： 执行select语句，返回2维数组
         * 参数：$sql 字符串类型， select 语句
         */

        public function getAll($sql){
           
           
            // 执行基本query 语句，得到结果
            $result = $this->query($sql);
            $arr = array();
            while ($rec = mysql_fetch_assoc($result)){
                $arr[] = $rec; //形成二维数组
            }
            return $arr;
        }
        // 返回一行数据（作为一维数组）
        public function getRow($sql){
            $result = $this->query($sql);

            if($rec2 = mysql_fetch_assoc( $result )){
                // 如果fetch出来有数据，就取得一行，结果自然是数组

                return $rec2;
            }
            return false;
        }
        // 返回一个数据，（select 语句的第一行第一列）
        // 比如常见 select count(*) as c from xxx where... 

        public function getOne($sql){
            $result = $this->query($sql);
            $rec =  mysql_fetch_row( $result );
            if($rec == false){
                return false;
            }
            return $rec[0];  //获得该组的第一项
        }

        // 转义用户数据，防止SQL注入
        // @param $data string 待转义的数据
        // @return string 转义后的字符串

        public function  escapeString($data){
            return "'". mysql_real_escape_string($data,$this->resourc) . "'";
        }

    }
?>
    