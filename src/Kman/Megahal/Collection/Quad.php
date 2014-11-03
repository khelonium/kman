<?php
/**
 * A collection of quads. 
 * Quads are identified by their signature.
 * @author  khelo
 */
class Kman_Megahal_Collection_Quad implements Kman_Megahal_Collection_Quad_Interface
{
    private $_quads = array();
    
    
    public function add(Quad $quad)
    {
        $signature = $quad->getSignature();
        
        if(!isset($this->_quads[$signature])){
            $this->_quads[$signature] = $quad;
        }
        
        return $this->_quads[$signature];
    }
    
    
    public function getQuad($signature)
    {
       if(true == $this->hasSignature($signature)) {
           return $this->_quads[$signature];
       }
       
       return null;
    }
    
    public function hasQuad(Quad $quad)
    {
        $signature = $quad->getSignature();
        return $this->hasSignature($signature);
    }
    
    /**
     * Checks if a certain signature is present in the collection.
     *
     * @param string $signature
     */
    private function hasSignature($signature)
    {
         if(isset($this->_quads[$signature])) {
            return true;
        }
        
        return false;        
    }
    
    /**
     * Returns a random quad.
     * @return Quad
     */
    public function getRandomQuad()
    {
        return $this->_quads[array_rand($this->_quads,1)];
    }
    
    
    public function count()
    {
        return count($this->_quads);
    }
    
    public function dump()
    {
        $content = array();
        foreach($this->_quads as $quad) {
            $content[] = $quad->dump();
        }
        
        return implode("\n",$content);
    }
    
    public function import($file)
    {
        if(!is_file($file)) {
            $this->raise("No such file $file");
        }
        $fp = fopen($file,"r");
        while(!feof($fp)) {
            $serialized_quad = fgets($fp);
            $quad_array = unserialize($serialized_quad);
            $quad = new Quad( $quad_array[0],$quad_array[1],$quad_array[2],$quad_array[3]);
            $this->add($quad);
        }
    }
    
    private function raise($message)
    {
        throw new Exception($message);
    }
}
?>