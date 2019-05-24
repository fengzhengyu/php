<?php
// session 入库工具类

class SessionDB {
  private $_dao;


  public function __construct()
  {
    // 设置处理器
    ini_set('session_set_save_handler','user');
    session_set_save_handler(
      // open,close,read,write,destroy,gc
      // 类的方法设置为调用的结构时，必须设为数组
      array($this,'userSessionBegin'),
      array($this,'userSessionEnd'),
      array($this,'userSessionRead'),
      array($this,'userSessionWrite'),
      array($this,'userSessionDelete'),
      array($this,'userSessionGc')
     
    );
    // 开启
    session_start();
  }
  function userSessionBegin(){
    // 初始化DAO
    $config = array(
      'host' => 'localhost',
      'port' => '3306',
      'username' => 'root',
      'password' => 'root',
      'charset' => 'utf8',
      'dbname' => 'demo7',
    );
    $this->_dao = MysqlDB::getInstance($config);
  


  }
  function userSessionEnd(){
  
    return true;
  }

  /**
   * 读工作
   * 执行时机：ession 机制开启程序中执行
   * 工作： 从当前session数据区读取内容
   * @param $sess_id  string
   * @return string 
   * 
   * */ 
  function userSessionRead($sess_id){
    
   
    //  查询 
    $sql = "select session_content from `demo_session` where session_id='$sess_id'";
    return (string) $this->_dao->getOne($sql);
    
  }
   /**
   * 写工作
   * 执行时机：脚本周期结束时，PHP在整理首尾时
   * 工作：将当前脚本处理好的session数据，持久化存储到数据中！
   * @param $sess_id  string
   * @param $sess_content  string  序列化好的 session内容字符串
   * @return bool
   * 
   * */ 
  function userSessionWrite($sess_id,$sess_content){
    
  
    //  查询  //数据库 时间戳
    $sql = "replace into  `demo_session` values ('$sess_id','$sess_content',unix_timestamp())";
    //$sql = "insert into  `session` values ('$sess_id','$sess_content') on duplicate key update session_content='$sess_content',last_time=unix_timestamp()";
    // 同上面一样
    return $this->_dao->query($sql);
  }

   /**
   * 删除工作
   * 执行时机：调用了session_destroy() 销毁session过程中被调用
   * 工作： 删除当前session的数据区 （记录）
   * @param $sess_id  string
   * @return string 
   * 
   * */ 
  function userSessionDelete($sess_id){
   
   
    //  删除 
    $sql = "delete from `demo_session` where session_id='$sess_id'";

    return $this->_dao->query($sql);
  }
    /**
   * 垃圾回收操作
   * 执行时机：开启session机制时 有概率的执行
   * 工作： 删除那些过期的session的数据区 （记录）
   * @param $max_lifetime  
   * @return bool
   * 
   * */ 
  function userSessionGC($max_lifetime){
    
   
    // 当前时间》 最后处理时间+ 最大生命时间
    // 写法 最好 字段 在左边
    $sql = "delete from `demo_session` where  last_time<unix_timestamp()-$max_lifetime";
    return $this->_dao->query($sql);
  }

}