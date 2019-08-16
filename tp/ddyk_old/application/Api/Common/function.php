<?php
//随机生成32位字符串//Api/Index
function guid() {
    $charId = strtoupper(md5(uniqid(mt_rand(), true)));
    return $charId;
}

//验证码函数
function authCode($phone){

    $rand = rand(100,999).rand(100,999);

    // $arr = array(
    //     'memberPhone'=>$phone,
    //     'memberAuthCode'=>$rand,
    //     'endTime'=>time()+900,
    // );

    // $model = M("member_auth");
    // $data = $model -> where("memberPhone='".$phone."' and endTime>'".time()."'") ->select();
    // if(empty($data)){
    //     $res = $model -> add($arr);
    //     return $rand;
    // }else{
    //     return  $data[0]['memberAuthCode'];
    // }

    $array = array(
        'member_phone'=>$phone,
        'member_authCode'=>$rand,
        'end_time'=>time()+900
    );
    $data = M('member_auth')->where("member_phone='".$phone."' abd end_time>'".time()."'")->select();
    if(empty($data)){
        $res = $model -> add($array);
        return $rand;
    }else{
        return  $data[0]['member_authCode'];
    }

}
//去除二维数组里重复的值
function more_array_unique($arr=array()){
    foreach($arr[0] as $k => $v){
        $arr_inner_key[]= $k;   //先把二维数组中的内层数组的键值记录在在一维数组中
    }
    foreach ($arr as $k => $v){
        $v =join(",",$v);    //降维 用implode()也行
        $temp[$k] =$v;      //保留原来的键值 $temp[]即为不保留原来键值
    }
    $temp =array_unique($temp);    //去重：去掉重复的字符串
    foreach ($temp as $k => $v){
        $a = explode(",",$v);   //拆分后的重组 如：Array( [0] => james [1] => 30 )
        $arr_after[$k]= array_combine($arr_inner_key,$a);  //将原来的键与值重新合并
    }
    return $arr_after;
}

/**
 * @desc arraySort php二维数组排序 按照指定的key 对数组进行排序
 * @param array $arr 将要排序的数组
 * @param string $keys 指定排序的key
 * @param string $type 排序类型 asc | desc
 * @return array
 */
function arraySort($arr, $keys, $type = 'asc') {
    $keysvalue = $new_array = array();
    foreach ($arr as $k => $v){
        $keysvalue[$k] = $v[$keys];
    }
    $type == 'asc' ? asort($keysvalue) : arsort($keysvalue);
    reset($keysvalue);
    foreach ($keysvalue as $k => $v) {
        $new_array[$k] = $arr[$k];
    }
    return $new_array;
}

/**
 * 微信扫码支付
 * @param  array $order 订单 必须包含支付所需要的参数 body(产品描述)、total_fee(订单金额)、out_trade_no(订单号)、product_id(产品id)
 */
function weixinpay($order){
    $order['trade_type']='NATIVE';
    Vendor('Weixinpay.Weixinpay');
    $weixinpay=new \Weixinpay();
    $weixinpay->pay($order);


}

/**
 * 生成二维码
 * @param  string  $url  url连接
 * @param  integer $size 尺寸 纯数字
 */
function qrcode($url,$size=4){
    Vendor('Phpqrcode.phpqrcode');
    QRcode::png($url,false,QR_ECLEVEL_L,$size,2,false,0xFFFFFF,0x000000);
}

//日志测试
function writeLog($filename,$msg){
    $res = array();
//        dump($msg);
//        $data = array_pop(explode(":",$msg));
    $msg="-------------".$msg;
    if(file_exists($filename) && abs(filesize($filename))>0){
        $content = $msg;
    }
    //往日志文件内容后面追加日志内容
    file_put_contents($filename, $content.PHP_EOL, FILE_APPEND);
    return $res;

}

/**
 * 使用curl获取远程数据
 * @param  string $url url连接
 * @return string      获取到的数据
 */
function curl_get_contents($url){
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);                //设置访问的url地址
    // curl_setopt($ch,CURLOPT_HEADER,1);               //是否显示头部信息
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);               //设置超时
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);   //用户访问代理 User-Agent
    curl_setopt($ch, CURLOPT_REFERER,$_SERVER['HTTP_HOST']);        //设置 referer
    curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);          //跟踪301
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        //返回结果
    $r=curl_exec($ch);
    curl_close($ch);
    return $r;
}
//
function https_post($url,$data){
    $curl = curl_init();
    curl_setopt($curl,CURLOPT_URL,$url);
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);
    curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,FALSE);
    if(!empty($data)){
        curl_setopt($curl,CURLOPT_POST,1);
        curl_setopt($curl,CURLOPT_POSTFIELDS,$data);

    }
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;

}
function https_get($url){

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;

}


 // 加密

function encrypt($key, $plain_text)
 {

   $plain_text = trim($plain_text);

   $iv = substr(md5($key), 0, mcrypt_get_iv_size(MCRYPT_CAST_256, MCRYPT_MODE_CFB));

   $c_t = mcrypt_cfb(MCRYPT_CAST_256, $key, $plain_text, MCRYPT_ENCRYPT, $iv);

   return trim(chop(base64_encode($c_t)));

 }
//解密
 function decrypt($key, $c_t)
 {

   $c_t = trim(chop(base64_decode($c_t)));

   $iv = substr(md5($key), 0, mcrypt_get_iv_size(MCRYPT_CAST_256, MCRYPT_MODE_CFB));

   $p_t = mcrypt_cfb(MCRYPT_CAST_256, $key, $c_t, MCRYPT_DECRYPT, $iv);

   return trim(chop($p_t));

 }