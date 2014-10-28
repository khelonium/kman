<?php
interface Kman_Megahal_Collection_Quad_Interface extends Countable 
{
    /**
     * Checks if collection has quad.
     *
     * @param Kman_Megahal_Quad $quad
     * @return bool
     */
    public function hasQuad(Kman_Megahal_Quad $quad);
    
    /**
     * Adds quad to collection
     *
     * @param Kman_Megahal_Quad $quad
     */
    public function add(Kman_Megahal_Quad $quad);
    
    
    /**
     * Gets a quad based on a signature.
     *
     * @param string $signature
     * @return Kman_Megahal_Quad|null
     */
    public function getQuad($signature);
    
}
?>