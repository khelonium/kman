<?php
/**
 * Created by PhpStorm.
 * User: cdordea
 * Date: 04/11/14
 * Time: 10:51
 */

namespace Kman\Communicator;

use FooBrain;
use FooCommand;
use FooCommunicator;

class AbstractCommunicatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FooCommunicator
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
        $command = new FooCommand();
        $this->communicator->addCommand($command);
        $this->communicator->getResponse('I am a response');
        $this->assertTrue($command->wasCalled());
    }



    /**
     * @test
     */
    function commandsWhichDoNotMatchAreNotCalled()
    {
        $command = new FooCommand();
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
     * @before
     */
    public function initCommunicator()
    {
        $this->communicator = new FooCommunicator();
        $this->brain = new FooBrain();
        $this->communicator->setBrain($this->brain);
    }

}
 