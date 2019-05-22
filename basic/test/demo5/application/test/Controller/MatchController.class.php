<?php

    // 比赛操作相关控制器功能
    require './framework/Controller.class.php';
    class MatchController extends Controller{
        // 比赛列表操作
        public function listAction(){
           
            
            require './framework/Factory.class.php';
            $m_match = Factory::M('MatchModel');
            $match_list = $m_match->getList();

            //载入负责显示的html
            require './application/test/View/match_view.html';
        }

        // 比赛删除

        public function removeAction(){
    
            echo '删除成功页面！';
        }
    }
