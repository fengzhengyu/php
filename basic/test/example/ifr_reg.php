<?php

    $user = $_GET['username'];
    $message = '';
    if( $user == 'admin'){
        $message = '对不起，该用户已存在！';
    }else{
        $message = '恭喜你，该用户可以用！';
    }
    // echo $user;
  echo "<input type='hidden' name='' value='$message' id='input_h' >";
echo <<<STR
<script  language="javascript">
    var str = document.getElementById('input_h');
   window.parent.document.getElementById('message').innerHTML =  str.value;
</script>
STR;
