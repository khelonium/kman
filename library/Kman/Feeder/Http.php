<?php
class Kman_Feeder_Http 
{
    public static $END_CHARS = "^.!?";
    
    /**
     * Holds brain instance.
     *
     * @var Kman_Megahal
     */
    
    private $brain = null;
    
    /**
     * Constructor.
     *
     * @param Kman_Megahal $brain
     */
    public function __construct($brain = null)
    {
        $this->setBrain($brain);
    }
    
    /**
     * Sets the brain
     *
     * @param Kman_Megahal $brain
     */
    public function setBrain($brain)
    {
        $this->brain = $brain;
    }
    
    
    private function checkBrainInPlace()
    {
        if(null == $this->brain) {
            throw new Exception("Brain not in place.");
        }
    }
    
    /**
     * Adds an entire documents to the 'brain'.  Useful for feeding in
     * stray theses, but be careful not to put too much in, or you may
     * run out of memory!
     * @param string $uri the stream location , accesible to php
     */
    public function add($uri) 
    {
        $this->checkBrainInPlace();

        $fp = @fopen($uri,'r');
        
        if(!is_resource($fp)) {
            return false;
        }
        $content = '';
        while(!feof($fp)) {
        
            $line = trim(fgetss($fp));
            $line = str_replace("\n",'',$line);
            $line = str_replace("\r",'',$line);
            
            
            if($line == '') {
                continue;
            }
            
            if(str_word_count($line) < 2) {
//                $line .= ' ';
//                continue;
            }
            
            $line .= ' ';
            $line = str_replace("&nbsp;",'',$line);
            $line = str_replace("&copy;",'',$line);
            
            $line = html_entity_decode($line);
            $content .= $line;
            
        }
        fclose($fp);
        // YE,  this sucks , but i am hasty        
        $handler = tmpfile();

        fwrite($handler,$content);
//        $handler = fopen($uri,"r");  
        rewind($handler);   
        
//        $content  = file_get_contents($uri);
        
        $buffer = "";
        while(($ch = fgetc($handler)) !== false) {
            $buffer .= $ch;
            if(strpos(self::$END_CHARS,$ch) > 0) {
                $this->addBuffer($buffer);
                $buffer = "";
            }
        }
        
        $this->addBuffer($buffer);
        return true;
    }
    
	/**
     * Ads a buffer of data to the brain.
     * It also performs necessary strings operations.
     * @param string $buffer
     */
    private function addBuffer($buffer)
    {
        if(strlen($buffer) == 0 ) {
            return;
        }
        $sentence = $buffer;
        $sentence = str_replace("\r"," ",$sentence);
        $sentence = str_replace("\n"," ",$sentence);
        $this->brain->add($sentence);
    }
    
}
?>