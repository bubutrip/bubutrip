<?php
/**
 * 扩展Mcrypt应用类--加密解密
 * @author flyer0126
 * @since   2012/12
 */
class Mcrypt 
{
	// 加密密钥
	private $key = '';
	// 加密算法
	private $cipher = '';
	// 加密模式
	private $mode = '';

	/**
	 * 构造器
	 * @param [type] $cipher [description]
	 */
	function __construct($cipher=MCRYPT_DES)
	{
		if (!function_exists('mcrypt_module_open')) {
			return false;
		}

		if (empty($cipher)) {
			return false;
		}

		$this->cipher = $cipher;
	}

	/**
	 * 设置mode
	 * @param [type] $mode [description]
	 */
	function setMode($mode)
	{
		if (!strlen($mode)) {
			return false;
		}

		if (!in_array($mode, mcrypt_list_modes()))
		{
			return false;
		}
		$this->mode = $mode;
	}

	/**
	 * 设置mode
	 * @param  [type] $key [description]
	 * @return [type]      [description]
	 */
	function setkey($key)
	{
		if (empty($key)) {
			return false;
		}

		$this->key = $key;

	}

	/**
	 * PHP DES 加密程式
	 *
	 * @param $key 密鑰（八個字元內）
	 * @param $encrypt 要加密的明文
	 * @return string 密文
	 */
	function testencrypt ($key, $encrypt)
	{
		#echo $this->cipher.'<br>';
		#echo $this->key.'<br>';

	    // 根據 PKCS#7 RFC 5652 Cryptographic Message Syntax (CMS) 修正 Message 加入 Padding
	    $block = mcrypt_get_block_size(MCRYPT_DES, MCRYPT_MODE_ECB);
	    $pad = $block - (strlen($encrypt) % $block);
	    $encrypt .= str_repeat(chr($pad), $pad);
	 
	    // 不需要設定 IV 進行加密
	    $passcrypt = @mcrypt_encrypt($this->cipher, $key, $encrypt, MCRYPT_MODE_ECB);
	    return base64_encode($passcrypt);
	}
	 
	/**
	 * PHP DES 解密程式
	 *
	 * @param $key 密鑰（八個字元內）
	 * @param $decrypt 要解密的密文
	 * @return string 明文
	 */
	function testdecrypt ($key, $decrypt)
	{
	    // 不需要設定 IV
	    $str = @mcrypt_decrypt($this->cipher, $key, base64_decode($decrypt), MCRYPT_MODE_ECB);
	 
	    // 根據 PKCS#7 RFC 5652 Cryptographic Message Syntax (CMS) 修正 Message 移除 Padding
	    $pad = ord($str[strlen($str) - 1]);
	    return substr($str, 0, strlen($str) - $pad);
	}


	function std_class_object_to_array($stdclassobject)
	{
	    $_array = is_object($stdclassobject) ? get_object_vars($stdclassobject) : $stdclassobject;

	    foreach ($_array as $key => $value) {
	        $value = (is_array($value) || is_object($value)) ? std_class_object_to_array($value) : $value;
	        $array[$key] = $value;
	    }

	    return $array;
	}
}