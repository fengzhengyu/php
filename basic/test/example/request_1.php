<?php
//模拟请求

  $url = 'http://php.com/basic/test/demo8/index.php?p=admin&c=Goods&a=list';
  $info=parse_url($url); //解析url 数组
  // var_dump($info);
  $host = 'fengzheng1778.cn';
  $port = '80';
  $link = fsockopen($host,$port);
  define('CRLF', "\r\n"); //CRLF 换行回车

  // var_dump(  $link); //resource(2) of type (stream) 连接资源
  // 请求行
  $request_data = 'GET / HTTP/1.1' . CRLF;
    // 请求头
  $request_data .= 'Host: fengzheng1778.cn'.CRLF;
  $request_data .= 'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:66.0) Gecko/20100101 Firefox/66.0'.CRLF;
  $request_data .= 'Connection: close'.CRLF; //close 执行完关闭 keep-alive
  $request_data .= CRLF;
  // 请求主体

  // 发送
  fwrite($link,$request_data);
  // $res = fgets($link,1024); //1K1k的接受
  // 响应处理
  $text='';
  while(!feof($link)){
    $text .=fgets($link,1024);
  }
  echo $text;
// 关闭资源流
  fclose($link);
  
 