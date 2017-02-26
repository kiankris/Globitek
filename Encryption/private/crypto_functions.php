<?php

// Symmetric Encryption

// Cipher method to use for symmetric encryption
const CIPHER_METHOD = 'AES-256-CBC';

function key_encrypt($message, $key, $cipher_method=CIPHER_METHOD) {
	// create a key of legth 32
	$key = str_pad($key, 32, '*');

	$iv_length = openssl_cipher_iv_length(CIPHER_METHOD);
	$iv = openssl_random_pseudo_bytes($iv_length);

	$encrypted = openssl_encrypt($message, CIPHER_METHOD, $key, OPENSSL_RAW_DATA, $iv);
	$encrypted_message = $iv . $encrypted;

  return base64_encode($encrypted_message);
}

function key_decrypt($string, $key, $cipher_method=CIPHER_METHOD) {
		$key = str_pad($key, 32, '*');
		$iv_with_ciphertext = base64_decode($string);

		$iv_length = openssl_cipher_iv_length(CIPHER_METHOD);
		$iv = substr($iv_with_ciphertext, 0, $iv_length);
		$ciphertext = substr($iv_with_ciphertext, $iv_length);

		$plaintext = openssl_decrypt($ciphertext, CIPHER_METHOD, $key, OPENSSL_RAW_DATA, $iv);

		return $plaintext;
}


// Asymmetric Encryption / Public-Key Cryptography

// Cipher configuration to use for asymmetric encryption
const PUBLIC_KEY_CONFIG = array(
    "digest_alg" => "sha512",
    "private_key_bits" => 2048,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
);

function generate_keys($config=PUBLIC_KEY_CONFIG) {
	$resource = openssl_pkey_new($config);
	openssl_pkey_export($resource, $private_key);
	$key_details = openssl_pkey_get_details($resource);
  $public_key = $key_details["key"];

  return array('private' => $private_key, 'public' => $public_key);
}

function pkey_encrypt($string, $public_key) {
	openssl_public_encrypt($string, $encrypted, $public_key);
  return base64_encode($encrypted);
}

function pkey_decrypt($string, $private_key) {
	$ciphertext = base64_decode($string);
	openssl_private_decrypt($ciphertext, $decrypt, $private_key);
  return $decrypt;
}


// Digital signatures using public/private keys

function create_signature($data, $private_key) {
  // A-Za-z : ykMwnXKRVqheCFaxsSNDEOfzgTpYroJBmdIPitGbQUAcZuLjvlWH
  return 'RpjJ WQL BImLcJo QLu dQv vJ oIo Iu WJu?';
}

function verify_signature($data, $signature, $public_key) {
  // Vigenère
  return 'RK, pym oays onicvr. Iuw bkzhvbw uedf pke conll rt ZV nzxbhz.';
}

?>
