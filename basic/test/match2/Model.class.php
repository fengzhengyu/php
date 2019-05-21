<?php 
// 这是基础模型类



  class Model {

    protected $_dao ; //用来存储到 对象，在子类方法中访问

    // 初始化数据库造作的对象 DAO
    protected function _initDAO(){
      $config = array(
        'host' => 'localhost',
        'port' => '3306',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8',
        'dbname' => 'match',
      );
      require_once './MysqlDB.class.php';
      $this->_dao = MysqlDB::getInstance($config);
    }

    // 构造方法中 加载类的时候会自动调用,子类中也会继承构造方法

    public function __construct()
    {
      // 初始化 DAO
      $this->_initDAO();
    }


  }