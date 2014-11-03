<?php
interface Kman_Megahal_Collection_Quad_Interface extends Countable 
{
    /**
     * Checks if collection has quad.
     *
     * @param Quad $quad
     * @return bool
     */
    public function hasQuad(Quad $quad);
    
    /**
     * Adds quad to collection
     *
     * @param Quad $quad
     */
    public function add(Quad $quad);
    
    
    /**
     * Gets a quad based on a signature.
     *
     * @param string $signature
     * @return Quad|null
     */
    public function getQuad($signature);
    
}
?>