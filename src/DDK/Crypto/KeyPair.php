<?php

namespace DDK\Crypto;


class KeyPair
{
    public static function makePublickey (string $secret)
    {
        $keypair = sodium_crypto_sign_keypair();
        $secretkey = sodium_crypto_sign_secretkey($keypair);
        $publickey = sodium_crypto_sign_publickey($keypair);
        $hash = sodium_crypto_generichash($secret, $publickey);
        return bin2hex($hash);
    }
}
