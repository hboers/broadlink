<?php

namespace HBO\Broadlink\Device;


interface HasTemperatureSensorInterface
{
    public function getTemperature():float;
}