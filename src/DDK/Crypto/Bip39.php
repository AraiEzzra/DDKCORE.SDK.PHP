<?php

namespace DDK\Crypto;


use \BitWasp\Bitcoin\Crypto\Random\Random;
use \BitWasp\Bitcoin\Mnemonic\MnemonicFactory;
use \BitWasp\Bitcoin\Mnemonic\Bip39\Bip39Mnemonic;

class Bip39
{
    public function generate ()
    {
        $random = new Random();
        $entropy = $random->bytes(Bip39Mnemonic::MIN_ENTROPY_BYTE_LEN);
        $bip39 = MnemonicFactory::bip39();
        $mnemonic = $bip39->entropyToMnemonic($entropy);
        return $mnemonic;
    }
}
