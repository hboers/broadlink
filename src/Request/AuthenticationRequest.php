<?php

namespace HBO\Broadlink\Request;


use HBO\Broadlink\Device\DeviceInterface;
use HBO\Broadlink\Packet\Packet;
use HBO\Broadlink\Packet\PacketBuilder;
use HBO\Broadlink\Response\AuthenticationResponse;
use HBO\Broadlink\Session;

class AuthenticationRequest implements RequestInterface
{

    public function execute(Session $session):AuthenticationResponse
    {
        $responsePacket = $session->sendCommand(DeviceInterface::COMMAND_AUTHENTICATE,Packet::createZeroPacket(0x50));
        return new AuthenticationResponse(new PacketBuilder($responsePacket));
    }


}