<?php

  function userSessionBegin(){
    echo 'begin<br>';
  }
  function userSessionEnd(){
    echo 'end<br>';
  }
  function userSessionRead(){
    echo 'read<br>';
  }
  function userSessionWrite(){
    echo 'write<br>';
  }
  function userSessionDelete(){
    echo 'delete<br>';
  }
  function userSessionGC(){
    echo 'gc<br>';
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