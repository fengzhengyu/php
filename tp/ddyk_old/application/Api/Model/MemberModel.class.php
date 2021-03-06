<?php

namespace Api\Model;
use Think\Model;
class MemberModel extends Model {

  public function findMember($where,$field){
    $info = M('member')->where($where)->field($field)->find();

    return $info;

  }
  public function insertMember($data){
    $id = M('member')->add($data);
    return $id;

  }

  	// 加密

	public function encrypt($key, $plain_text) {

		$plain_text = trim($plain_text);

		$iv = substr(md5($key), 0,mcrypt_get_iv_size (MCRYPT_CAST_256,MCRYPT_MODE_CFB));

		$c_t = mcrypt_cfb (MCRYPT_CAST_256, $key, $plain_text, MCRYPT_ENCRYPT, $iv);

		return trim(chop(base64_encode($c_t)));

	}
	//解密
	public function decrypt($key, $c_t) {

		$c_t = trim(chop(base64_decode($c_t)));

		$iv = substr(md5($key), 0,mcrypt_get_iv_size (MCRYPT_CAST_256,MCRYPT_MODE_CFB));

		$p_t = mcrypt_cfb (MCRYPT_CAST_256, $key, $c_t, MCRYPT_DECRYPT, $iv);

		return trim(chop($p_t));

	}
  
}