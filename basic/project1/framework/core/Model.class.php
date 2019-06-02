<?php
// 基础模型类   

class Model {
  protected $db;    //数据库连接对象
  protected $table; //表名
  protected $fields = array(); //字段；列表

 
  public function __construct($table) {
    
    $dbconfig['host'] = $GLOBALS['config']['host'];
    $dbconfig['user'] = $GLOBALS['config']['user'];
    $dbconfig['password'] = $GLOBALS['config']['password'];
    $dbconfig['dbname'] = $GLOBALS['config']['dbname'];
    $dbconfig['port'] = $GLOBALS['config']['port'];
    $dbconfig['charset'] = $GLOBALS['config']['charset'];

    $this->db = new Mysql($dbconfig);
    $this->table= '`' .$GLOBALS['config']['prefix'] . $table .'`';
    
    // 获取字段
    $this->getFields();
     
  }

   /**
     * 获取当前表的所有字段
     */
  public function getFields()
  {
      //查看表结构
      $sql = "desc {$this->table}";
    
      //执行并发送SQL
      $result = $this->db->getAll($sql);
   
      foreach ($result as $v){
        $this->fields[] = $v['Field'];


        if($v['Key'] == 'PRI'){
          // 如果存在主键 则 将其存储在变量 $pk 中
          $pk = $v['Field'];
        }
      }
      // 如果主键存在，则将其加入字段表中
      if(isset($pk)){
        $this->fields['pk']= $pk;
      }
     

      
  }


  /***
   * 自动插入数据
   * @param $list array 关联数组
   * @return mixed(混合) 成功返回插入的id 失败返回false
   * 
   * */ 
  public function insert($list){  

    
   
    // 
    $field_list = ''; // 字段列表字符串
    $value_list = ''; // 值列表字符串

    foreach($list as $k=>$v){

      if(in_array($k,$this->fields)){
        $field_list.= "`" .$k."`" . ',';
        $value_list.= "'" .$v."'" . ',';
      } 
    }
   
    // 去除右边的括号
    $field_list = rtrim( $field_list,',');
    $value_list = rtrim( $value_list,',');
    // 构造SQL 语句
   

    // echo $field_list;
    // echo $value_list;
    // die;
    $sql= "INSERT INTO $this->table ({$field_list}) VALUES ($value_list)";

    if($this->db->query($sql)){
      // 插入成功 返回最后插入的记录id
      return $this->db->getInsertId();

    }else{
      return false;
    }
  }


  /**
   * 自动更新数据
   * @param $list array 关联数组
   * @return mixed(混合) 成功返回插入的id 失败返回false
   * */ 
  public function update($list){
    $uplist= '';  //跟新字符串
    $where = 0 ;  //更新条件 默认为0 
    foreach($list as $k=>$v){
      if(in_array($k,$this->fields)){
        if($k == $this->fields['pk']){
           // 是主键 
          $where = "`$k`=$v";
        }else{
          $uplist .= "`$k`='$v'" . ",";
        }
      }  
    }
    // 去除右边的 ，
    $uplist = rtrim($uplist,',');
    $sql = "UPDATE {$this->table} set {$uplist} WHERE {$where}";
    // return$this->db->query($sql);
    if($this->db->query($sql)){
   // 插入成功 返回最后插入的记录id
      if($row= mysql_affected_rows()){
        return $row;
      }else{
        return false;
      }
    }else{
      return false;
    }

  }

   /**
   * 自动删除数据
   * @param $pk   mixed(混合)  可以是一个整形 也可以是数组
   * @return mixed(混合) 成功返回插入的id 失败返回false
   * */ 
  public function delete($pk){
    $where = 0; //条件字符串
  
    // 判断是数组还是单值
    if(is_array($pk)){
      $where = "`{$this->fields['pk']}` in (". implode(',',$pk) .")";
      
    }else{
      $where = "`{$this->fields['pk']}`=$pk";
     
    }
   
    // 构造SQL语句
    $sql = "DELETE FROM {$this->table} WHERE $where ";
    if($this->db->query($sql)){
      if($row= mysql_affected_rows()){
        return $row;
      }else{
        return false;
      }
    }else{
      return false;
    }
  }

    /***
   *  根据主键得到信息
   * @param $list array 关联数组
   * @return mixed(混合) 成功返回插入的id 失败返回false
   * 
   * */ 
  public function selectByPk($pk){
    $sql = "select * from {$this->table} where {$this->fields['pk']} = $pk";

    return $this->db->getRow($sql);
  }

  /** 
   *  获取总记录数
   * @param $where string  where条件
   * @return number  总数
   * */
  public function total($where){

    if(empty($where)){
      $sql = "select count(*) from {$this->table}";
    }else{
      $sql = "select count(*) from {$this->table} where $where";
    }

    return $this->db->getOne($sql);
  }

   /** 
   *  分页获取信息
   * @param $offset int  偏移量
   * @param $limit int 每次取得记录条数
   * @param $where string  where条件
   * @return number  总数
   * */
}