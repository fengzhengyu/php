<?php
  // 
class Mysql
{
  protected $conn = false; //数据库连接资源
  protected $sql;  //sql 语句

  public function __construct($config = array())
  {
    // 初始化数据
    $host = isset($config['host']) ? $config['host'] : 'localhost'; //iset()是否存在
    $port = isset($config['port']) ? $config['port'] : '3306';
    $username = isset($config['user']) ? $config['user'] : 'root';
    $password = isset($config['password']) ? $config['password'] : 'root';
    $charset = isset($config['charset']) ? $config['charset'] : 'utf8';
    $dbname = isset($config['dbname']) ? $config['dbname'] : ''; 

      // 连接数据库
    $this->conn = mysql_connect("$host:$port", $username, $password) or die('数据库连接失败');
      // 选择数据库
    mysql_select_db($dbname) or die('数据库选择错误');
      // 设定连接编码
    $this->setCharset($charset);


  }
  // 设置 编码
  public function setCharset($charset)
  {
    $sql = 'set names ' . $charset;
    $this->query($sql);
  }
  // 执行SQL 语句
  public function query($sql)
  {

    $this->sql = $sql;
    $result = mysql_query($this->sql, $this->conn);
    if (!$result) {
      die('<br>出错语句为' . $this->sql . '<br>');
      // $this->errno() . ':' . $this->error() . 
    }
    return $result;

  }
  //获取第一条记录第一个字段，（select 语句的第一行第一列）
  public function getOne($sql)
  {
    $result = $this->query($sql);
    $row = mysql_fetch_row($result);
    if ($row) {
      return $row[0];
    } else {
      return false;
    }

  }

  //获取一条记录
  public function getRow($sql)
  {
    if ($result = $this->query($sql)) {
      $row = mysql_fetch_assoc($result);
      return $row;
    } else {
      return false;
    }

  }

   //获取所有记录
  public function getAll($sql)
  {
    $result = $this->query($sql);
    $list = array();

    while ($row = mysql_fetch_assoc($result)) {
      $list[] = $row;

    }
    return $list;
  }

     //获取某一列的值
  public function getCol($sql)
  {
    $result = $this->query($sql);
    $list = array();

    while ($row = mysql_fetch_row($result)) {
      $list[] = $row;

    }
    return $list;
  }
  public function getInsertId(){
    return mysql_insert_id($this->conn);
  }


}