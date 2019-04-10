<?php

namespace DDK\Crypto;

class KeyPair
{
    const CRYPTO_SIGN_SECRETKEYBYTES = 64;
    const CRYPTO_SIGN_PUBLICKEYBYTES = 64;

    public static function makePublickey (string $secret)
    {
        $keypair = sodium_crypto_sign_keypair();
        $secretkey = sodium_crypto_sign_secretkey($keypair);
        $publickey = sodium_crypto_sign_publickey($keypair);
        $hash = sodium_crypto_generichash($secret, $publickey);
        return bin2hex($hash);
    }

    public static function makeKeyPair (string $secret)
    {
        $binKeyPair = sodium_crypto_sign_seed_keypair(hash('sha256', $secret, true));
        $hexKeyPair = bin2hex($binKeyPair);
        return array('publicKey' => substr($hexKeyPair, 0, self::CRYPTO_SIGN_SECRETKEYBYTES),
        'secretKey' => substr($hexKeyPair, self::CRYPTO_SIGN_SECRETKEYBYTES, self::CRYPTO_SIGN_PUBLICKEYBYTES)
        );
    }
}
