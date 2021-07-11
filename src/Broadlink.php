<?php

namespace HBO\Broadlink;


use HBO\Broadlink\Command\AuthenticateCommand;
use HBO\Broadlink\Command\CommandInterface;
use HBO\Broadlink\Command\DiscoverCommand;
use HBO\Broadlink\Device\AuthenticatedDevice;
use HBO\Broadlink\Device\Device;
use HBO\Broadlink\Device\DeviceInterface;
use HBO\Broadlink\Device\DiscoveredDevice;

class Broadlink
{
    /**
     * Return all devices in current network
     * @return DiscoveredDevice[]
     */
    public static function discover():array {
        $protocol = Protocol::create();
        $discoverCommand = new DiscoverCommand();
        $devices = [];
        foreach($protocol->executeCommand($discoverCommand) as $device){
            $devices[] = $device;
        }
        return $devices;
    }

    public static function authenticate(DeviceInterface $device,$authenticatedClass = AuthenticatedDevice::class):AuthenticatedDevice{
        $protocol = Protocol::create();
        $discoverCommand = new AuthenticateCommand($device,$authenticatedClass);
        return $protocol->executeCommand($discoverCommand)->current();
    }
}