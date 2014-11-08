<?php
/**
 * Created by PhpStorm.
 * User: cdordea
 * Date: 08/11/14
 * Time: 02:58
 */

namespace unit\Kman\Communicator\Command;


use Kman\Communicator\Command\Uptime;

class UptimeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    function itMatchesUptime()
    {
        $command = new Uptime();
        $this->assertTrue($command->matches('uptime'));
        $this->assertFalse($command->matches('uptime2'));
    }

    /**
     * @test
     */
    function itReturnsAStingWithTheUptime()
    {
        $command = new Uptime();
        $response = $command->execute('uptime');
        $this->assertEquals('0.00 minutes', $response);
    }
}
 