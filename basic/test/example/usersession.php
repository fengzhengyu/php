<?php
  // 创建 session 表
  // 对应session 文件
  // create table `session`(
  //   session_id varchar(40) not null default '',
  //   session_text text,
  //   last_time int not null default 0,
  //   primary key(session_id)
  // ) charset=utf8 engine=myisam;

  function userSessionBegin(){
    echo 'begin<br>';
    // 初始化数据库
    mysql_connect('127.0.0.1','root','root');
    mysql_query('set names utf8');
    mysql_query('use `demo7`');


  }
  function userSessionEnd(){
    echo '<br>end<br>';
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
    echo '<br>read<br>';
   
    //  查询 
    $sql = "select session_text from `session` where session_id='$sess_id'";
    $result =mysql_query($sql);
    if($row = mysql_fetch_assoc($result)){ //有资源始终返回true
      return $row['session_text'];
    }else {
      // 没找到返回空字符串
      return '';
    }
  }
   /**
   * 写工作
   * 执行时机：脚本周期结束时，PHP在整理首尾时
   * 工作：将当前脚本处理好的session数据，持久化存储到数据中！
   * @param $sess_id  string
   * @param $sess_text  string  序列化好的 session内容字符串
   * @return bool
   * 
   * */ 
  function userSessionWrite($sess_id,$sess_text){
    echo '<br>write<br>';
  
    //  查询  //数据库 时间戳
    $sql = "replace into  `session` values ('$sess_id','$sess_text',unix_timestamp())";
    //$sql = "insert into  `session` values ('$sess_id','$sess_text') on duplicate key update session_text='$sess_text',last_time=unix_timestamp()";
    // 同上面一样
    return mysql_query($sql);
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
    echo '<br>delete<br>';
   
    //  删除 
    $sql = "delete from `session` where session_id='$sess_id'";
  
   
    return mysql_query($sql);

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
    echo 'gc<br>';
   
    // 当前时间》 最后处理时间+ 最大生命时间
    // 写法 最好 字段 在左边
    $sql = "delete from `session` where  last_time<unix_timestamp()-$max_lifetime";
    return mysql_query($sql);
  }

  // 设置
  session_set_save_handler(
    'userSessionBegin',
    'userSessionEnd',
    'userSessionRead',
    'userSessionWrite',
    'userSessionDelete',
    'userSessionGC'
  );
  ini_set('session_set_save_handler','user');