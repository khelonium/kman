<?php
/**
 * Created by PhpStorm.
 * User: cdordea
 * Date: 04/11/14
 * Time: 10:02
 */

namespace functional;


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

class FooBrain implements \BrainInterface
{
    private $sentenceAdded;

    /**
     * Adds a new sentence to the 'brain'
     * @param string $sentence add a sentence to the brain
     */
    public function add($sentence)
    {
       $this->sentenceAdded = true;
    }

    public function sentenceWasAdded()
    {
       return $this->sentenceAdded;
    }

    /**
     * Generate a sentence that includes (if possible) the specified word.
     * @param string $word
     */
    public function getSentence($word = null)
    {
        // TODO: Implement getSentence() method.
    }

    public function save()
    {
        // TODO: Implement save() method.
    }

    public function load()
    {
        // TODO: Implement load() method.
    }

}
 