<?php 
	function signing_checksum($string){
		$salt = "qiFQ23Hasdf39faW";
		return hash('sha1', $string, $salt);
	}

	function sign_string($string){
		return $string . '--' . signing_checksum($string);
	}

	const CIPHER_METHOD = 'AES-256-CBC';

	$plaintext = "I have a secret to tell" ;
	$key = 'a1b2c3d4e5';

	$key = str_pad($key, 32, '*');

	$iv_length = openssl_cipher_iv_length(CIPHER_METHOD);
	$iv = openssl_random_pseudo_bytes($iv_length);

	$encrypted = openssl_encrypt($plaintext, CIPHER_METHOD, $key, OPENSSL_RAW_DATA, $iv);

	$message = $iv . $encrypted;

	echo "Before signing: " . base64_encode($message) . "</br>";
	$message = sign_string($message); 
	setcookie("scrt", $message);
	echo "After signing: " . base64_encode($message) . "</br>";
?>

