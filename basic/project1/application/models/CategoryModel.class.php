<?php
  // 分类模型
  class CategoryModel extends Model {

    // 查询获取所有分类信息

    public function getCats(){
      $sql = "SELECT * FROM {$this->table}";
      $cats = $this->db->getAll($sql);
       return $this->tree($cats);
    }

    /**
     * 定义 方法 用于形成树状结构
     * @param $arr array  给定数组
     * @param $pid int 从哪个节点开始找
     * @return array  构造好的数组
     * 
     * 
     * **/ 
    public  function tree($arr,$pid=0,$level=0){
      //$tree 不适用递归 每次调用 进来 都清空，只能找到最后的 
      static $tree = array();
      foreach($arr as $v){
        if($v['parent_id'] == $pid){
          $v['level']= $level;
          $tree[] = $v;
          // 找到 继续递归
          $this->tree($arr,$v['cat_id'],$level+1);
        }
      }
      return $tree;
    }

    // 获取编辑信息
    public function getEdit($pk){

       return   $this->selectByPk($pk);
    }

    // 获取所有指定节点的id
    public function getSubIds($pid){
      $sql = "SELECT * FROM {$this->table}";
      $cats = $this->db->getAll($sql);
      $cats_list =  $this->tree($cats,$pid);
      $list = array();
      foreach($cats_list as $cat){
        $list[] = $cat['cat_id'];
      }
      return $list;
    }


    
  }