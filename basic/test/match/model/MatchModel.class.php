<?php 
/***
 *  match 表的操作模型类
 * 
 */

require_once 'Model.class.php';

class MatchModel extends Model
{

    //获得所有比赛列表
  public function getList()
  {

    $sql = "select t1.t_name as t1_name,m.t1_score,m.t2_score,t2.t_name as t2_name, m.m_time from `match` as m  left join `team` as t1 ON m.t1_id = t1.t_id left join `team` as t2 ON m.t2_id = t2.t_id";

    return $this->_dao->getAll($sql);

  }

  // 删除比赛数据
  public function removeMatch($m_id)
  {
    $sql = "delete from `match` where m_id=$m_id";
    $this->_dao->query($sql);

  }
}  