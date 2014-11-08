<?php
/**
 * Created by PhpStorm.
 * User: cdordea
 * Date: 08/11/14
 * Time: 02:37
 */

namespace Kman\Communicator\Command;


use Kman\Brain\Util\BrainAwareInterface;
use Kman\Brain\Util\BrainAwareTrait;
use Kman\Communicator\CommandInterface;
use Kman\Feeder\Http;

class Feed implements  CommandInterface, BrainAwareInterface
{
    use BrainAwareTrait;

    /**
     *
     * Executes the actions associated with the command
     * @return string
     */
    public function execute($message)
    {

        if (!$this->matches($message)) {
            throw new \DomainException("This should not have been executed \n");
        }
        list($command, $uri) = $this->getParams($message);

        $feeder = new Http(($this->getBrain()));
        $result = $feeder->add($uri);

        return $result ? "Feed was added" : "Something went wrong. Feed was not added";
    }

    /**
     * detects if the $input is of interest to the command, so that other entities
     * can decide if the command is executed or not
     * @param $message
     * @return bool
     */
    public function matches($message)
    {


        list($command, $uri) = $this->getParams($message);

        if (strpos($uri, 'http://') !== 0) {
            return false;
        }


        return 'feed' == $command;
    }

    /**
     * @param $message
     * @param $matches
     * @return array
     */
    private function getParams($message)
    {
        $matches = [];
        preg_match("/^(\S+) (.*)/", $message, $matches);
        $command = $matches[1];
        $uri = $matches[2];
        return array($command, $uri);
    }


}