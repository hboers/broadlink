<?php namespace HBO\Broadlink\Device;

use HBO\Broadlink\Command\EncryptedCommandInterface;
use HBO\Broadlink\Command\GetEnergyCommand;
use HBO\Broadlink\Command\GetSensorsCommand;
use HBO\Broadlink\Command\SetSensorsCommand;
use HBO\Broadlink\Packet\PacketBuilder;
use HBO\Broadlink\Protocol;

class SP2Device extends AuthenticatedDevice
{
    public function checkPower() {
        return in_array(
            $this->executeGetSensorCommand(),
            [1, 3, 253]
        );
    }

    public function checkNightLight() {
        return in_array(
            $this->executeGetSensorCommand(),
            [2, 3, 255]
        );
    }

    public function getEnergy() {
        /** @var PacketBuilder $pack */
        $packetBuilder = $this->executeCommand(new GetEnergyCommand($this));

        return (
            dechex($packetBuilder->readByte(0x7)) * 10000 +
            dechex($packetBuilder->readByte(0x6)) * 100 +
            dechex($packetBuilder->readByte(0x5)) / 100
        );
    }

    public function setPower(bool $state) {
        $command = new SetSensorsCommand($this);
        $packetBuilder = $command->getPacketBuilder();
        $packetBuilder->writeByte(0x00, 0x02);

        if ($this->checkNightLight()) {
            $packetBuilder->writeByte(0x04, $state ? 3 : 2);
        } else {
            $packetBuilder->writeByte(0x04, $state ? 1 : 0);
        }

        $this->executeCommand($command);
    }

    public function setNightLight(bool $state) {
        $command = new SetSensorsCommand($this);
        $packetBuilder = $command->getPacketBuilder();
        $packetBuilder->writeByte(0x00, 0x02);

        if ($this->checkPower()) {
            $packetBuilder->writeByte(0x04, $state ? 3 : 1);
        } else {
            $packetBuilder->writeByte(0x04, $state ? 2 : 0);
        }

        $this->executeCommand($command);
    }

    /**
     * @return int
     * @throws \Exception
     */
    private function executeGetSensorCommand() {
        return $this->executeCommand(new GetSensorsCommand($this))->readByte(0x04);
    }

    private function executeCommand(EncryptedCommandInterface $command) {
        return Protocol::create()->executeCommand($command)->current();
    }
}