<?php
// 分页类
// 共几条信息，每页显示几条记录 当前为 1/2 [首页][上一页][下一页][尾页]
// index.php?p=admin&c=brand&a=index&page=1

class Page {
    // 属性
    private $total;                   //总记录条数
    private $pagesize;                   //每页显示的记录条数
    private $current;                   //当前页
    private $pagenum;                   //总页数
    private $first;                   //首页
    private $last;                   //尾页
    private $prev;                   //上一页
    private $next;                   //下一页
    private $url;                   //地址


    /**
     * 构造方法
     * @param script string  超链接地址的文件名 不带任何参数
     * @param params  array  超链接地址的参数
     * 
     * ***/ 
    public function __construct($total,$pagesize,$current,$script,$params=array()){
        $this->total = $total;
        $this->pagesize = $pagesize;
        $this->current = $current;
        $this->pagenum = ceil($total/$pagesize);
        // new Page(100,10,1,'index.php',array('p'=>'admin','c'=>'admin','a'=>'index'));
        $temp = array();
        foreach($params as $k=>$v){
            $temp[] = "$k=$v";
        }
        $str = implode('&',$temp);
        $this->url = "$script?{$str}&page=";
        $this->first = $this->getFirst(); //得到首页超链接
        $this->last = $this->getLast(); //
        $this->prev = $this->getPrev(); //
        $this->next = $this->getNext(); //

        
    }
    private function getFirst(){
        // 判断是不是首页

        if($this->current == 1){
            return "[首 页]";
        }else{
            return "<a href='{$this->url}1'>[首 页]</a>";
        }
    }
    private function getLast(){
        

        if($this->current ==  $this->pagenum){
            return "[尾 页]";
        }else{
            return "<a href='{$this->url}{$this->pagenum}'>[尾 页]</a>";
        }
    }
    private function getPrev(){
        
        if($this->current == 1){
            return "[上一页]";
        }else{
            return "<a href='{$this->url}" .($this->current-1). "'>[上一页]</a>";
        }
    }
    private function getNext(){
       

        if($this->current == $this->pagenum){
            return "[下一页]";
        }else{
            return "<a href='{$this->url}" . ($this->current+1). "'>[下一页]</a>";
        }
    }

    public function showPage(){
      if($this->pagenum >= 1){
        return "共有{$this->total}条记录，每页显示{$this->pagesize}条记录,当前尾{$this->current}/{$this->pagenum} {$this->first} {$this->prev} {$this->next} {$this->last}";
      }
      return '';
    }
}