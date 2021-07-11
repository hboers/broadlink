<?php

namespace HBO\Broadlink\Command\Authenticated\Sp;

use HBO\Broadlink\Command\Authenticated\AbstractAuthenticatedDeviceCommand;
use HBO\Broadlink\Device\AuthenticatableDeviceInterface;
use HBO\Broadlink\Packet\Packet;
use HBO\Broadlink\Packet\PacketBuilder;

class NightLightCommand extends AbstractAuthenticatedDeviceCommand
{
    /**
     * @var bool
     */
    private $state;

    /**
     * @var bool
     */
    private $poweredOn;

    public function __construct(AuthenticatableDeviceInterface $device, bool $poweredOn, bool $state)
    {
        parent::__construct($device);

        $this->poweredOn = $poweredOn;
        $this->state = $state;
    }

    public function getPayload(): Packet
    {
        $state = $this->state ? 2 : 0;

        if ($this->poweredOn) {
            $state = $this->state ? 3 : 1;
        }

        return PacketBuilder::create(0x16)
            ->writeByte(0x00, 0x02)
            ->writeByte(0x04, $state)
            ->getPacket()
        ;
    }
}
