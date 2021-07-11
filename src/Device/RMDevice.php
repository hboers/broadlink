<?php

namespace HBO\Broadlink\Device;


use HBO\Broadlink\Command\GetSensorsCommand;
use HBO\Broadlink\Packet\PacketBuilder;
use HBO\Broadlink\Protocol;

class RMDevice extends AuthenticatedDevice
{
    public function getTemperature(){
        /** @var PacketBuilder $result */
        $result = Protocol::create()->executeCommand(new GetSensorsCommand($this))->current();
        return $result->readFloat16(0x4);
    }
}