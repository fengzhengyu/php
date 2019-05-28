<?php 
// 这是基础模型类



  class Model {

    protected $_dao ; //用来存储到 对象，在子类方法中访问
    protected $_table;  //真实的表名
    // 初始化数据库造作的对象 DAO
    protected function _initDAO(){
      $config = $GLOBALS['config']['db'];
      $this->_dao = MysqlDB::getInstance($config);
    }

    // 构造方法中 加载类的时候会自动调用,子类中也会继承构造方法

    public function __construct()
    {
      // 初始化 DAO
      $this->_initDAO();
      // 初始化真实表名
      $this->_initTable();
    }

    // 批量转义的方法（防止注入）
    protected function escapeStringAll($data){
      foreach($data as $key=>$value){
        $data[$key] = $this->_dao->escapeString($value);
      }
      return $data;
    }

    //初始化 拼接前缀+表名
    protected function _initTable(){
      // 表名使用反引号 包裹，不会出现额外的逻辑问题
      $this->_table = '`' . $GLOBALS['config']['app']['table_prefix'] . $this->_logic_table  . '`' ; //保护的 可以在父类中调用
    }

  }