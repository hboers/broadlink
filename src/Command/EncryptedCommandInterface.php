<?php
namespace HBO\Broadlink\Command;


use HBO\Broadlink\Packet\Packet;

interface EncryptedCommandInterface extends CommandInterface
{
    public function getPayload():Packet;
}