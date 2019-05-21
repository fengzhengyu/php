<?php
    // 比赛操作相关控制器功能

    class MatchController {
        // 比赛列表操作
        public function listAction(){
            header('Content-Type: text/html; charset=utf-8;');
            
            require './Factory.class.php';
            $m_match = Factory::M('MatchModel');
            $match_list = $m_match->getList();

            //载入负责显示的html
            require './template/match_view.html';
        }

        // 比赛删除

        public function removeAction(){
            header('Content-Type: text/html; charset=utf-8;');
            echo '删除成功页面！';
        }
    }
