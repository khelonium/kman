<?php
use Kman\Brain\Util\BrainAwareTrait;

/**
 * Created by PhpStorm.
 * User: cdordea
 * Date: 04/11/14
 * Time: 10:58
 */



class TestCommand implements \Kman\Communicator\CommandInterface, \Kman\Brain\Util\BrainAwareInterface
{

    use BrainAwareTrait;

    private $match         = true;
    private $called        = false;

    public function matches($message)
    {
        return $this->match;
    }

    public function willMatch()
    {
        $this->match = true;
    }

    public function willNotMatch()
    {
        $this->match = false;
    }

    public function execute($message)
    {
        $this->called = true;
        return "FooCommand $message";
    }

    /**
     * @return boolean
     */
    public function wasCalled()
    {
        return $this->called;
    }

}