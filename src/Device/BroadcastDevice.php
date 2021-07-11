<?php

namespace HBO\Broadlink\Device;


use HBO\Broadlink\Cipher\Cipher;
use HBO\Broadlink\Cipher\CipherInterface;

final class BroadcastDevice implements DeviceInterface
{
    public function getMac(): string
    {
        return '';
    }

    public function getIP(): string
    {
        return '255.255.255.255';
    }

    public function getPort(): int
    {
        return 80;
    }

    public function getCipher(): CipherInterface
    {
        return new Cipher(self::BASE_KEY,self::BASE_IV);
    }
}