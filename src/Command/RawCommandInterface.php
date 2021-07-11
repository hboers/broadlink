<?php

namespace HBO\Broadlink\Command;


use HBO\Broadlink\Packet\Packet;

interface RawCommandInterface extends CommandInterface
{
    public function getPacket(): Packet;
}