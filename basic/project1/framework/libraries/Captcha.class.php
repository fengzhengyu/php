<?php

class Captcha
{

  // 生成验证码
  // @param $code_len 默认是4位码值
  // @return viod

  public function generate($code_len = 4)
  {
    ob_clean();
    //默认返回的是黑色的照片
    $image = imagecreatetruecolor(100, 30);
    //将背景设置为白色的
    $bgcolor = imagecolorallocate($image, 255, 255, 255);
    //将白色铺满地图
    imagefill($image, 0, 0, $bgcolor);
    $char_str = 'abcdefghkmnprstuvwxyzABCDEFGHKMNPRSTUVWXYZ23456789';
    $char_str_len = strlen($char_str) - 1;
    //空字符串，每循环一次，追加到字符串后面  
    $captch_code = '';

    //验证码为随机四个数字
    for ($i = 0; $i < $code_len; $i++) {
      $fontsize = 6;
      $fontcolor = imagecolorallocate($image, rand(0, 120), rand(0, 120), rand(0, 120));

      //产生随机数字0-9  rand(0,9);
      $fontcontent = substr($char_str, rand(0, $char_str_len), 1);
      $captch_code .= $fontcontent;
      //  //数字的位置，0，0是左上角。不能重合显示不完全
      $x = ($i * 100 / 4) + rand(5, 10);
      $y = rand(5, 10);
      // $fontwidth=imagefontwidth($fontsize);
      // $fontheight=imagefontheight($fontsize);
      // $x=$i*((100-$fontwidth*strlen($fontcontent))/4);
      // $y=(30-$fontheight)/2;
      imagestring($image, $fontsize, $x, $y, $fontcontent, $fontcolor);
    }

    @session_start();

    $_SESSION['authcode'] = $captch_code;
    //为验证码增加干扰元素，控制好颜色点   
    for ($i = 0; $i < 200; $i++) {
      $pointcolor = imagecolorallocate($image, rand(50, 200), rand(50, 200), rand(50, 200));
      imagesetpixel($image, rand(1, 99), rand(1, 29), $pointcolor);
    }

    //为验证码增加干扰元素线   
    for ($i = 0; $i < 4; $i++) {
      $linecolor = imagecolorallocate($image, rand(80, 220), rand(80, 220), rand(80, 220));
      imageline($image, rand(1, 99), rand(1, 29), rand(1, 99), rand(1, 29), $linecolor);
    }

    header('content-type:image/png');
    imagepng($image);

    //销毁
    imagedestroy($image);
  }

  // 验证验证码
  // @param $authcode 输入验证码
  // @return bool
  public function checkCaptcha($authcode)
  {
    @session_start();
    // strcasecmp 不区分为大小写 ： 返回为负 第一个小，返回为正 第一个大， 返回0 两个相当
    // strcmp() 也类似 不过区分大小写
    $result = isset($authcode) && isset($_SESSION['authcode']) && (strcasecmp($authcode, $_SESSION['authcode']) == 0);
    // 安全考虑 消除session 验证码
    unset($_SESSION['authcode']);
    return $result;
  }


  // 调用实例
  // $captcha =new Captcha();
  // $captcha->generate();
  // $captcha->checkCaptcha($authcode)
}
