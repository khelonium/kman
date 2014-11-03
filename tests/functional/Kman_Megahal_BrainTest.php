<?php
/**
 * Created by PhpStorm.
 * User: cdordea
 * Date: 03/11/14
 * Time: 16:50
 */

class Kman_Megahal_BrainTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    function itCanConstruct()
    {
        $brain = new Kman_Megahal_Brain();
        $brain->add('is nothing really');
        $sentence = $brain->getSentence("test");
        $this->assertTrue(strpos($sentence,'nothing') !== false);
    }
}
 