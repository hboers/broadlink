<?php

namespace HBO\Broadlink\Command;

use HBO\Broadlink\Device\AuthenticatedDevice;
use HBO\Broadlink\Device\Device;
use HBO\Broadlink\Device\DeviceInterface;
use HBO\Broadlink\Packet\Packet;
use HBO\Broadlink\Packet\PacketBuilder;

class GetSensorsCommand implements EncryptedCommandInterface
{
    /**
     * @var Device
     */
    private $device;

    public function __construct(AuthenticatedDevice $device)
    {
        $this->device = $device;
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

    public function getPayload(): Packet
    {
        return PacketBuilder::create(0x16)->writeByte(0x00,0x01)->getPacket();
    }

}