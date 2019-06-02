<?php
// 处理输入的函数文件
    function f1(){
        echo 'f1... helper';
    }
 
    // 批量转义
    // 
    function deepslashes($data){
        // 单一处理
        // 一维数组处理
        // 多维数组处理

        if(empty($data)){
            return $data;
        }
        // 中高级写法

        return is_array($data)?  array_map('deepslashes',$data):  addslashes($data);
        // if(is_array($data)){ 遍历数组 对数组中的每一个元素做操作 php 提供了 array_map()
        //     // 数组

        //     foreach($data as $v){
        //         // 递归调用 单个数据走下面 数组继续递归
        //         return deepslashes($v);
        //     }
        // }else{
        //     // 单一数据
        //     return addslashes($data);
        // }

    }

    // 批量实体转义
    function deepspecialchars($data){

        if(empty($data)){
            return $data;
        }
        return is_array($data)?  array_map('deepspecialchars',$data): htmlspecialchars($data);

    }