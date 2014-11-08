<?php
/**
 * Created by PhpStorm.
 * User: cdordea
 * Date: 08/11/14
 * Time: 22:03
 */

namespace unit\Kman\Communicator\Command;


use Kman\Communicator\Command\Feed;
use Kman\Megahal\Brain;

class FeedTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @expectedException DomainException
     */
    function givenAnInvalidMessageExceptionIsThrown()
    {
        $command = new Feed();

        $command->execute("Not so valid  input \n");
    }
    /**
     * @skip
     */
    function givenAValidMessage_itWillFeedTheBrain()
    {
        $brain = new \FooBrain();
        $command = new Feed();
        $command->setBrain($brain);


        echo $command->execute('feed http://refactoring.ro');

        $this->assertTrue($brain->sentenceWasAdded());
    }

}
 