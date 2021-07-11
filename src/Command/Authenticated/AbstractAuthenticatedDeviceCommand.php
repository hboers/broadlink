<?php

namespace HBO\Broadlink\Command\Authenticated;

use HBO\Broadlink\Command\EncryptedCommandInterface;
use HBO\Broadlink\Device\AuthenticatableDeviceInterface;
use HBO\Broadlink\Command\CommandInterface;
use HBO\Broadlink\Device\NetDeviceInterface;
use HBO\Broadlink\Packet\Packet;

abstract class AbstractAuthenticatedDeviceCommand implements EncryptedCommandInterface
{
    /**
     * @var AuthenticatableDeviceInterface
     */
    protected $device;

    public function __construct(AuthenticatableDeviceInterface $device)
    {
        $this->device = $device;
    }

    public function getCommandId(): int
    {
        return CommandInterface::COMMAND_GET_INFO;
    }

    public function getDevice(): NetDeviceInterface
    {
        return $this->device;
    }

    public function handleResponse(Packet $packet)
    {
        return $packet;
    }
}
