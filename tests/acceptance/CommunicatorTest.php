<?php
/**
 * Created by PhpStorm.
 * User: cdordea
 * Date: 09/11/14
 * Time: 08:07
 */

namespace acceptance;



class Communicator extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \TestCommunicator
     */
    private $communicator;


    /**
     * @var \TestCommand
     */
    private $command;


    /**
     * @test
     */
    function givenANotSoInterestingString_nothingWillExecuted()
    {

        $this->communicator->match("/I want to execute/", $this->command);

        $this->communicator->getResponse('I do not want to execute');

        $this->assertTrue($this->communicator->noMatchedCommandsExecuted());
    }


    /**
     * @test
     */
    function givenAStringThatMatches_commandWillBeExecuted()
    {

        $this->doBeforeTests();

        $this->communicator->match("/I want to execute/", $this->command);

        $this->communicator->getResponse('I want to execute');

        $this->assertTrue($this->command->wasCalled());

    }

    /**
     * @before
     */
    public function doBeforeTests()
    {
        $this->communicator = new \TestCommunicator();

        $this->command = new \TestCommand();
    }
}