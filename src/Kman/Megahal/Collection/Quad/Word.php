<?php
/**
 * A collection of quads that are identified by a word.
 * @author khelo
 */
class Kman_Megahal_Collection_Quad_Word implements Countable 
{
    private $_words = array();
    
    /**
     * Checks if the collection knows about a word.
     *
     * @param string $word word to check
     * @return boolean
     */
    public function hasWord($word)
    {
        if(isset($this->_words[$word])){
            return true;   
        }
        
        return false;
    }
    
    /**
     * Associates a quad with a word.
     *
     * @param string $word
     * @param Kman_Quad $quad
     */
    public function add($word,$quad)
    {
        $this->checkWord($word);
        $this->$word->add($quad);
    }
    
    private function checkWord($word)
    {
        if(!isset($this->_words[$word])) {
            $this->_words[$word] = new Kman_Megahal_Collection_Quad();    
        }
    }
    
    public function __get($name)
    {
        $word = $name;
        if(isset($this->_words[$word])){
            return $this->_words[$word];
        }
        
        return null;
    }
    
    public function __isset($name) 
    {
        if(isset($this->_words[$name])) {
            return true;
        }
        
        return false;
    }
    
    public function count()
    {
        return count($this->_words);
    }
    
}
 ?>