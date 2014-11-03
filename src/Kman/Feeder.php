<?php
/**
 * Feeds Kman with documents.
 * @author khelo
 */
class Kman_Feeder
{
    /**
     * Holds the brain that needs information.
     *
     * @var Kman_Megahal
     */
    private $brain = null;
    
    public function __construct($brain)
    {
        $this->setBrain($brain);
    }
    
    /**
     * Sets the brain.
     *
     * @param Kman_Megahal $brain
     */
    public function setBrain($brain)
    {
        $this->brain = $brain;
    }
    
    /**
     * Feeds the brain with a document.
     * 
     * @param string $uri
     */
    public function addDocument($uri)
    {
        $parser = new Kman_Feeder_Uri($this->brain);
        $parser->add($uri);
        unset($document);
    }
}
?>