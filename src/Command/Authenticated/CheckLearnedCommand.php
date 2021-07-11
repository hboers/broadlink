<?php

namespace HBO\Broadlink\Command\Authenticated;

use HBO\Broadlink\Packet\Packet;
use HBO\Broadlink\Packet\PacketBuilder;

class CheckLearnedCommand extends AbstractAuthenticatedDeviceCommand
{
    public function getPayload(): Packet
    {
        return PacketBuilder::create(0x16)->writeByte(0x00, 0x04)->getPacket();
    }

    public function handleResponse(Packet $packet)
    {
        return (new PacketBuilder($packet))->extractFromIndex(4);
    }
}
