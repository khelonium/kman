<?php
interface BrainInterface
{
    /**
     * Adds a new sentence to the 'brain'
     * @param string $sentence add a sentence to the brain
     */
    public function add($sentence);
    
     /**
     * Generate a sentence that includes (if possible) the specified word.
     * @param string $word
     */
    public function getSentence($word = null);
    
    public function save();
    
    public function load();
}