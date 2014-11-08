<?php
namespace Kman\Feeder;

use Kman\Megahal\Brain;
use PHPUnit_Framework_TestCase;


class BrainTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Brain
     */
    private $brain;

    /**
     * @before
     */
    function itCanConstruct()
    {
        $this->brain = new Brain();

    }

    /**
     * @test
     */
    function itRespondsBasedOnASeed()
    {
        $brain = $this->brain;
        $brain->add('is nothing really');
        $sentence = $brain->getSentence("test");
        $this->assertTrue(strpos($sentence,'nothing') !== false);
    }

}
 