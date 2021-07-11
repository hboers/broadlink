<?php

namespace HBO\Broadlink\Command\Authenticated\Sp;

use HBO\Broadlink\Command\Authenticated\AbstractAuthenticatedDeviceCommand;
use HBO\Broadlink\Packet\Packet;
use HBO\Broadlink\Packet\PacketBuilder;

class PowerStateCommand extends AbstractAuthenticatedDeviceCommand
{
    public function getPayload(): Packet
    {
        return PacketBuilder::create(0x16)->writeByte(0x00, 0x01)->getPacket();
    }

    public function handleResponse(Packet $packet)
    {
        $pb = new PacketBuilder($packet);

        if (!$pb->hasError()) {
            $state = $pb->readInt16(0x04);

            return in_array($state, [0x01, 0x03, 0xFD]);
        }

        return false;
    }
}
