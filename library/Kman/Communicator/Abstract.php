<?php
abstract class Kman_Communicator_Abstract implements Kman_Communicator_Interface
{
    private $_brain;

    public function __construct()
    {
        $this->_commandHolder = new Kman_Communicator_Command_Holder();
    }

    private $_commandHolder = null;
    
    
    /**
     * Sets the 'brain'.
     * Brain may be any bot implementation , 
     * at the moment Kman_Megahal.
     * @param Kman_Megahal $brain
     */
    public function setBrain(Kman_Brain_Interface $brain)
    {
        
        $this->_brain = $brain;
        $system = new Kman_Communicator_Command_System($this->_brain);
        $this->_commandHolder->attach($system);
    }
    
    /**
     * Returns the brain
     *
     * @return Kman_Brain_Interface
     */
    protected function getBrain()
    {
        return $this->_brain;
    }
    
   
    
    public function addCommand($command)
    {
        if($command instanceof SplObserver ) {
            $this->_commandHolder->attach($command);
        }
    }

    
    protected function match($message)
    {
        if($message == '') {
            return;
        }
        $this->_commandHolder->setMessage($message);
        return $this->_commandHolder->getResponse();
    }
    
    /**
     * Call this function to receive a message from the brain
     * or from the commands.
     *
     * @param string $message
     * @return string
     */
    public function getResponse($message)
    {
        if($message == '') {
            return null;
        }
        
        $brain    = $this->getBrain();
        
        $response = $this->match($message);
        
        if(!$response) {
            $brain->add($message);
            $term     =  $this->extractTerm($message) ;
            $response =  $brain->getSentence($term);
        }
        
        return $response;
    }
    
    protected function extractTerm($message)
    {
        return Kman_Lexic_Term_Extractor::extract($message);
    }
    
    protected function log($message ,$priority=7)
    {
        Kman_Log::log($message, $priority);
    }
}
