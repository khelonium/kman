<?php
/**
 * Created by PhpStorm.
 * User: cdordea
 * Date: 04/11/14
 * Time: 10:02
 */



class FeederTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FooBrain
     */
    private $fooBrain;
    /**
     * @var \Kman\Feeder\Feeder
     */
    private $feeder;
    private $filename;

    /**
     * @before
     */
    function itCanConstruct()
    {
        $this->fooBrain = new FooBrain();
        $this->feeder = new \Kman\Feeder\Feeder($this->fooBrain);
        $this->filename = 'kman_test.txt';

    }

    /**
     * @test
     */
    function itCanAddAUri()
    {

        file_put_contents($this->filename, 'I am a foo');
        $this->feeder->addDocument($this->filename);
        $this->assertTrue($this->fooBrain->sentenceWasAdded());
    }

    /**
     * @after
     */
    function clean()
    {
        unlink($this->filename);
    }
}

