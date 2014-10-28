<?php
/**
 * A collection of  words
 * @author khelo
 */
class Kman_Megahal_Collection_Word implements Countable  
{ 
    private $words = array();
    
    /**
     * Adds a word to the collection.
     * The word is added only if it doesn't allready exists
     *
     * @param string $word
     */
    public function add($word)
    {
        if (!$this->has($word)) {
            $this->words[] = $word;
        }
    }
    
    /**
     * Checks if the collection contains a word.
     *
     * @param string $word
     * @return boolean
     */
    public function has($word)
    {
        return array_search($word , $this->words);
    }
    
    public function count()
    {
        return count($this->words);
    }
    
    /**
     * Generates a random word.
     * @return string
     */
    public function randomWord()
    {
        return $this->words[rand(0,count($this->words) -1)];
    }
    
    public function dump()
    {
        return serialize($this->words);
    }
}
 ?>