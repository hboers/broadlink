<?php

namespace HBO\Broadlink\Command;

use HBO\Broadlink\Device\AuthenticatedDevice;
use HBO\Broadlink\Device\Device;
use HBO\Broadlink\Device\DeviceInterface;
use HBO\Broadlink\Packet\Packet;
use HBO\Broadlink\Packet\PacketBuilder;

class SetSensorsCommand implements EncryptedCommandInterface
{
    /**
     * @var Device
     */
    private $device;

    /** @var PacketBuilder */
    private $packetBuilder;

    public function __construct(AuthenticatedDevice $device)
    {
        $this->device = $device;
        $this->packetBuilder = PacketBuilder::create(0x16);
    }

    public function getCommandId(): int
    {
        return CommandInterface::COMMAND_GET_INFO;
    }

    public function handleResponse(Packet $packet): PacketBuilder
    {
        return new PacketBuilder($packet);
    }

    public function getDevice(): DeviceInterface
    {
        return $this->device;
    }

    public function getPacketBuilder(): PacketBuilder
    {
        return $this->packetBuilder;
    }

    public function getPayload(): Packet
    {
        return $this->packetBuilder->getPacket();
    }

}