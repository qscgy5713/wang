<?php
class CryptDes {
	protected $key;
	protected $iv;
	public function __construct($key, $iv){
		$this->key = $key;
		$this->iv = $iv;
	}

	public function encrypt($input){
		$size = mcrypt_get_block_size(MCRYPT_DES,MCRYPT_MODE_ECB); //3DES加密?MCRYPT_DES改?MCRYPT_3DES
		$input = $this->pkcs5_pad($input, $size); //如果采用PaddingPKCS7，?更?成PaddingPKCS7方法。
		$key = str_pad($this->key,8,'0'); //3DES加密?8改?24
		$td = mcrypt_module_open(MCRYPT_DES, '', MCRYPT_MODE_ECB, '');
		if( $this->iv == '' ) {
			$iv = @ mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		} else {
			$iv = $this->iv;
		}
		@ mcrypt_generic_init($td, $key, $iv);
		$data = mcrypt_generic($td, $input);
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);
		$data = base64_encode($data);//如需??二?制可改成  bin2hex ??
		return $data;
	}

	public function decrypt($encrypted){
		$encrypted = base64_decode($encrypted); //如需??二?制可改成  bin2hex ??
		$key = str_pad($this->key,8,'0'); //3DES加密?8改?24
		$td = mcrypt_module_open(MCRYPT_DES,'',MCRYPT_MODE_ECB,'');//3DES加密?MCRYPT_DES改?MCRYPT_3DES
		if( $this->iv == '' ) {
			$iv = @ mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		} else {
			$iv = $this->iv;
		}
		$ks = mcrypt_enc_get_key_size($td);
		@ mcrypt_generic_init($td, $key, $iv);
		$decrypted = mdecrypt_generic($td, $encrypted);
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);
		$y=$this->pkcs5_unpad($decrypted);
		return $y;
	}

	protected function pkcs5_pad ($text, $blocksize) {
		$pad = $blocksize - (strlen($text) % $blocksize);
		return $text . str_repeat(chr($pad), $pad);
	}

	protected function pkcs5_unpad($text){
		$pad = ord($text{strlen($text)-1});
		if ($pad > strlen($text)) {
			return false;
		}
		if (strspn($text, chr($pad), strlen($text) - $pad) != $pad){
			return false;
		}
		return substr($text, 0, -1 * $pad);
	}

	protected function PaddingPKCS7($data) {
		$block_size = mcrypt_get_block_size(MCRYPT_DES, MCRYPT_MODE_ECB);//3DES加密?MCRYPT_DES改?MCRYPT_3DES
		$padding_char = $block_size - (strlen($data) % $block_size);
		$data .= str_repeat(chr($padding_char),$padding_char);
		return $data;
	}
}

?>
