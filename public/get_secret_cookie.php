<?php
	const CIPHER_METHOD = 'AES-256-CBC';

	function signing_checksum($string){
		$salt = "qiFQ23Hasdf39faW";
		return hash('sha1', $string, $salt);
	}

	function signed_string_is_valid($s_s){
		$arr = explode("--", $s_s);
		if(count($arr) != 2) return false;

		$check_sum = signing_checksum($arr[0]);
		return $check_sum === $arr[1];
	}


	
	if(signed_string_is_valid($_COOKIE["scrt"])){
		$arr = explode("--", $_COOKIE["scrt"]);
		$message = base64_encode($arr[0]);
		
		$key = 'a1b2c3d4e5'; 

		$key = str_pad($key, 32, '*');
		$iv_with_ciphertext = base64_decode($message);

		$iv_length = openssl_cipher_iv_length(CIPHER_METHOD);
		$iv = substr($iv_with_ciphertext, 0, $iv_length);
		$ciphertext = substr($iv_with_ciphertext, $iv_length);

		$plaintext = openssl_decrypt($ciphertext, CIPHER_METHOD, $key, OPENSSL_RAW_DATA, $iv);

		echo "Message is: " . ($plaintext). "</br>";
	} else
		echo "Invalid cookie";

?>
