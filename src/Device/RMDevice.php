<?php

namespace HBO\Broadlink\Device;



use HBO\Broadlink\Request\CheckSensorsRequest;
use HBO\Broadlink\Response\CheckSensorsResponse;

class RMDevice extends AbstractDevice implements HasTemperatureSensorInterface
{
    public function getTemperature():float {
        /** @var CheckSensorsResponse $response */
        return $this->executeRequest(new CheckSensorsRequest())->getTemperature();
    }
}