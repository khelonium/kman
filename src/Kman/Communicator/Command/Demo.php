<?php
namespace Kman\Communicator\Command;

use Kman\Communicator\CommandInterface;

class Demo implements CommandInterface
{
    public function execute($message)
    {
         return 'The word keyword was found';
    }

    /**
     * detects if the $input is of interest to the command, so that other entities
     * can decide if the command is executed or not
     * @param $message
     * @return bool
     */
    public function matches($message)
    {
        return is_int(strpos($message, 'keyword'));
    }
}
