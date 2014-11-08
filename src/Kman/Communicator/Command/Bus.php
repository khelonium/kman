<?php
namespace Kman\Communicator\Command;

use Kman\Brain\Util\BrainAwareInterface;
use Kman\Communicator\CommandInterface;

class Bus
{

    private $commands = [];
    private $_response = null;
    private $brain;


    public function handle($message)
    {
        $out  =[];
        /** @var CommandInterface $command */
        foreach ($this->commands as $command) {
            if ($command->matches($message)) {
                $out[] = $command->execute($message);
            }
        }

        return $out;
    }

    public function attach(CommandInterface $command)
    {
        $this->addBrainIfNecessary($command);

        $this->commands[] = $command;
    }

    public function setBrain($brain)
    {
        $this->brain = $brain;

        foreach ($this->commands as $command) {
            $this->addBrainIfNecessary($command);
        }
    }

    /**
     * @param CommandInterface $command
     */
    private function addBrainIfNecessary(CommandInterface $command)
    {
        if ($this->brain && $command instanceof BrainAwareInterface) {
            $command->setBrain($this->brain);
        }
    }


}