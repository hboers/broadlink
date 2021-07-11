<?php
namespace HBO\Broadlink\Command;

use HBO\Broadlink\Device\DeviceInterface;
use HBO\Broadlink\Packet\Packet;

interface CommandInterface
{
    const COMMAND_DISCOVER=0x06;
    const COMMAND_AUTHENTICATE=0x65;
    const COMMAND_GET_INFO=0x6a;

    public function getCommandId(): int ;
    public function handleResponse(Packet $packet);
    public function getDevice(): DeviceInterface;
}
