<?php
/**
 * Created by PhpStorm.
 * User: cdordea
 * Date: 08/11/14
 * Time: 02:52
 */

namespace unit\Kman\Communicator\Command;


use Kman\Communicator\Command\Demo;
use Kman\Communicator\CommandInterface;

class DemoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Demo
     */
    private $demo;

    /**
     * @before
     */
    function itCanConstruct()
    {
        $this->demo = new Demo();
    }

    /**
     * @test
     */
    function itWillMatchKeyword()
    {
        $this->assertTrue($this->demo->matches('keyword'));
        $this->assertFalse($this->demo->matches('foobar'));
    }

    function itWillReturnWhatIsExected()
    {
        $this->assertEquals('The word keyword was found', $this->demo->execute());
    }
}
 