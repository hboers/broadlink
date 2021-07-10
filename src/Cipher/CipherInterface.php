<?php

namespace HBO\Broadlink\Cipher;


use HBO\Broadlink\Packet\Packet;

interface CipherInterface
{
    public function encrypt(Packet $data):Packet;
    public function decrypt(Packet $data):Packet;
}