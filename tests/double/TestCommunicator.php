<?php
use Kman\Communicator\AbstractCommunicator;

/**
 * Created by PhpStorm.
 * User: cdordea
 * Date: 04/11/14
 * Time: 10:52
 */



class TestCommunicator extends AbstractCommunicator
{
    /**
     * Starts the communicator.
     * @return bool
     */
    public function connect()
    {

    }

    public function noMatchedCommandsExecuted()
    {
        return true;
    }

} 