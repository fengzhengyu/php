<?php

// 项目中的工厂类

class Factory {

  /*
   *  生成模型单例对象
   *  @param $model_name string
   *  $retun object
   * 
   */ 

  public static function M($model_name){
      static $model_lsit =array(); //储存已经实例化的模型对象的列表

      if(!isset($model_lsit[$model_name])){
        // 没事实例化的
        require  $model_name . '.class.php';
        $model_lsit[$model_name] = new $model_name;
      }
      return  $model_lsit[$model_name];
   }

}