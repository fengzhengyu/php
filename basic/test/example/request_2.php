<?php
//模拟post请求
  header('Content-Type:text/html;charset=utf8;');
  $path = 'http://php.com/basic/test/demo8/index.php?p=admin&c=Admin&a=check';
  $url=parse_url($path); //解析url 为数组
  // var_dump($url);
  $host = 'php.com';
  $port = '80';
  $link = fsockopen($host,$port);
  define('CRLF', "\r\n"); //CRLF 换行回车

  // var_dump(  $link); //resource(2) of type (stream) 连接资源
  // 请求行
  $request_data = 'POST /basic/test/demo8/index.php?p=admin&c=Admin&a=check HTTP/1.1' . CRLF;
    // 请求头
  $request_data .= 'Host: php.com'.CRLF;
  $request_data .= 'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:66.0) Gecko/20100101 Firefox/66.0'.CRLF;
  $request_data .= 'Connection: close'.CRLF; //close 执行完关闭 keep-alive
  $data = array('username'=>'feng','password'=>'123456','authcode'=>'a2d5');
  
  $post_content =  http_build_query($data);
  // echo   $post_content ;
  // die;

  $request_data .= 'Content-Length: '. strlen( $post_content) .CRLF; //主体的长度
  $request_data .= 'Content-Type: application/x-www-form-urlencoded'.CRLF; //主体的类型
  $request_data .= CRLF;
  // 请求主体
  
  $request_data .=   $post_content ;  

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
  
 