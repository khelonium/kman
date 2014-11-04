<?php
/**
 * Created by PhpStorm.
 * User: cdordea
 * Date: 04/11/14
 * Time: 10:49
 */

class FooBrain implements \Kman\Brain\BrainInterface
{
    private $sentenceAdded = false;

    private $sentenceWasRequested = false;

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
        return $this->sentenceAdded ;
    }

    /**
     * Generate a sentence that includes (if possible) the specified word.
     * @param string $word
     */
    public function getSentence($word = null)
    {
        $this->sentenceWasRequested = true;
    }

    public function save()
    {
        // TODO: Implement save() method.
    }

    public function load()
    {
        // TODO: Implement load() method.
    }

    /**
     * @return boolean
     */
    public function sentenceWasRequested()
    {
        return $this->sentenceWasRequested;
    }


}