<?php
$keyFile="D:/Software/xamp/htdocs/Project/person/encryption_key.txt";
$ivFile="D:/Software/xamp/htdocs/Project/person/iv.txt";

if (!file_exists($keyFile) || !file_exists($ivFile)) {
    $encryption_key = openssl_random_pseudo_bytes(32); // 256-bit key
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));

    file_put_contents($keyFile, base64_encode($encryption_key));
    file_put_contents($ivFile, base64_encode($iv));
}
$encryption_key = base64_decode(file_get_contents($keyFile));
$iv = base64_decode(file_get_contents($ivFile));
?>