<?php
use Kman\Megahal\Brain;

/**
 * Created by PhpStorm.
 * User: cdordea
 * Date: 03/11/14
 * Time: 16:50
 */

class Kman_Megahal_BrainTest extends PHPUnit_Framework_TestCase
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
        $this->brain = $brain = new Brain();

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
 