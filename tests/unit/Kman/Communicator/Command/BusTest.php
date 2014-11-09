<?php
/**
 * Created by PhpStorm.
 * User: cdordea
 * Date: 08/11/14
 * Time: 03:03
 */

namespace unit\Kman\Communicator\Command;


use Kman\Communicator\Command\Bus;

class BusTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Bus
     */
    private $bus;

    /**
     * @before
     */
    function itCanConstruct()
    {
        $this->bus = new Bus();
    }

    /**
     * @test
     */
    function givenACommandThatWillMatchIsAttached_itWillBeExecuted()
    {
        $command = new \TestCommand();
        $command->willMatch();

        $this->bus->attach($command);

        $this->bus->handle('Foo');

        $this->assertTrue($command->wasCalled());
    }


    /**
     * @test
     */
    function ifABrainIsSet_anExistingCommandsWillGetTheBrain()
    {

        $command = new \TestCommand();
        $brain = new \FooBrain();
        $this->bus->attach($command);
        $this->bus->setBrain($brain);


        $this->bus->handle("please");

        $this->assertEquals($brain, $command->getBrain());


    }



    /**
     * @test
     */
    function ifABrainIsSet_anCommandsAddedLaterWillGetTheBrain()
    {

        $command = new \TestCommand();
        $brain = new \FooBrain();
        $this->bus->setBrain($brain);

        $this->bus->attach($command);


        $this->bus->handle("please");

        $this->assertEquals($brain, $command->getBrain());

    }
}
 