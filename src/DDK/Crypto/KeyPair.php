<?php

namespace DDK\Crypto;

use BitWasp\Buffertools\Buffer;

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
        return array(
            'secretKey' => substr($hexKeyPair, 0, self::CRYPTO_SIGN_SECRETKEYBYTES),
            'publicKey' => substr($hexKeyPair, self::CRYPTO_SIGN_SECRETKEYBYTES, self::CRYPTO_SIGN_PUBLICKEYBYTES)
        );
    }

    public function getAddressFromPublicKey(string $key)
    {
        $hash = hash('sha256', hex2bin($key));
        $buffer = Buffer::hex($hash);

        $items = [];
        for ($i = 0; $i < 8; $i++) {
            $items[$i] = $buffer->slice((8 - 1 - $i), 1)->getHex();
        }

        return Buffer::hex(implode('', $items))->getInt();
    }
}
