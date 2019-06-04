<?php
// 商品属性模型
class AttributeModel extends Model {
    // 获得所有属性 

    public function getAttributies($type_id){
        // $sql = "SELECT * FROM {$this->table} WHERE type_id = $type_id";
        // 连表查询 会出现两个相同的字段  type_id  不用select * 

        $sql ="select a.* ,b.type_name from p1_attribute as a inner join 
         p1_goods_type as b on a.type_id = b.type_id 
         where a.type_id = $type_id";
        return $this->db->getAll($sql);
    }
    // 分页获取所有数据
    public function getPageAttrs($type_id,$offset,$pagesize){
        $sql ="select a.* ,b.type_name from p1_attribute as a inner join 
        p1_goods_type as b on a.type_id = b.type_id 
        where a.type_id = $type_id limit $offset,$pagesize";
       return $this->db->getAll($sql);
    }

    // 获取指定类型下的的属性
    public function getAttrList($type_id){
        $sql = "select * from {$this->table} where type_id= $type_id";
        $attrs = $this->db->getAll($sql);

        $res = '';

        foreach($attrs as $attr){
                $res .= "<div class='layui-form-item'>";
                $res .= "<label class='layui-form-label'>{$attr['attr_name']}</label>";
                $res .= "<div class='layui-input-block'>";
                $res .= "<input type='hidden' name='attr_id_list[]'  value='" .$attr['attr_id']."'>";
                switch($attr['attr_input_type']){
                    case 0: #文本框

                        $res .= "<input type='input' name='attr_value_list[]' autocomplete='off'  class='layui-input'>";
                        break;
                    case 1: #下拉列表
                        $res .= '<select name="attr_value_list[]"  required lay-verify="required" > <option value="">请选择</option>';
                        $opts = explode(PHP_EOL,$attr['attr_value']);
                        foreach($opts as $opt){
                            $res .= " <option value='".$opt."'>$opt</option>" ;

                        }
                        $res .= '</select>';

                       break;
                    case 2: # 多行文件
                      
                        $res .= "textarea  name='attr_value_list[]' class='layui-textarea'></textarea>";
                        break;

                }
              
                $res .= "<input type='hidden' name='attr_price_list[]' value='0'>";

                $res .= "</div>";
                $res .= "</div>";
                

        }
        return  $res;
    }

}