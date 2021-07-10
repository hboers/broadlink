<?php

namespace TPG\Broadlink\Command;

use TPG\Broadlink\Device\AuthenticatedDevice;
use TPG\Broadlink\Device\Device;
use TPG\Broadlink\Device\DeviceInterface;
use TPG\Broadlink\Packet\Packet;
use TPG\Broadlink\Packet\PacketBuilder;

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