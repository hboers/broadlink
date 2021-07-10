<?php

namespace HBO\Broadlink\Device;


interface DeviceResolverInterface
{
    public function getDeviceClass(int $deviceId);
}