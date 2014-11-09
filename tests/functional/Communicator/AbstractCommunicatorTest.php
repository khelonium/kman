<?php
/**
 * Created by PhpStorm.
 * User: cdordea
 * Date: 04/11/14
 * Time: 10:51
 */

namespace Kman\Communicator;

use FooBrain;
use TestCommand;
use TestCommunicator;

class AbstractCommunicatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TestCommunicator
     */
    private $communicator;

    /**
     * @var \FooBrain
     */
    private $brain;


    /**
     * @test
     */
    function commandsAreCalled()
    {
        $command = new TestCommand();
        $this->communicator->addCommand($command);
        $this->communicator->getResponse('I am a response');
        $this->assertTrue($command->wasCalled());
    }

    /**
     * @test
     */
    function commandsWhichDoNotMatchAreNotCalled()
    {
        $command = new TestCommand();
        $command->willNotMatch();
        $this->communicator->addCommand($command);
        $this->communicator->getResponse('I am a response');
        $this->assertFalse($command->wasCalled());
    }

    /**
     * @test
     */
    function brainIsCalled()
    {
        $this->communicator->getResponse("I am the brain");
        $this->assertTrue($this->brain->sentenceWasRequested());
    }

    /**
     * @test
     */
    function givenNoBrain_communicatorActsDumb()
    {
        $communicator = new TestCommunicator();
        $response     = $communicator->getResponse('This is it');

        $this->assertEquals("Nothing to be processed", $response[0]);;
    }

    /**
     * @before
     */
    public function initCommunicator()
    {
        $this->communicator = new TestCommunicator();
        $this->brain = new FooBrain();
        $this->communicator->setBrain($this->brain);
    }



}
 