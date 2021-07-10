<?php

namespace HBO\Broadlink\Request;


use HBO\Broadlink\Device\DeviceInterface;
use HBO\Broadlink\Packet\PacketBuilder;
use HBO\Broadlink\Response\CheckSensorsResponse;
use HBO\Broadlink\Session;

class CheckSensorsRequest implements RequestInterface,AuthenticatedRequestInterface
{
    public function execute(Session $session)
    {
        $responsePacket = $session->sendCommand(DeviceInterface::COMMAND_GET_INFO,PacketBuilder::create(0x16)->writeByte(0x00,0x01)->getPacket());
        return new CheckSensorsResponse(new PacketBuilder($responsePacket));
    }

}