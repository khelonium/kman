<?php
class Kman_Communicator_Command_System implements SplObserver 
{
    private $_brain    = null;
    
    private $_messages = 0;
    
    private $_start    = null;
    
    private $_subject  = null;
    /**
     * Oh yes, this is added within the communicator.
     *
     * @param Kman_Brain_Interface $brain
     */
    public function __construct($brain)
    {
        $this->_brain = $brain;
        $this->_start = time();
    }
    
    
    public function update(SplSubject $subject)
    {
        $this->_messages++;
        
        $this->_subject = $subject;
        
        if($this->_messages == 100) {
            Kman_Log::log('Autosaving');
            $this->_messages = 0;
            $this->_brain->save();
        }
        
        $message = $subject->getMessage();
        $this->debug("Recieved $message");
        if($message == 'uptime') {
            $this->debug("Uptime");
            $time = time();
            $diff = $time - $this->_start;
            $subject->setResponse(number_format($diff/60,2)." minutes");
        }
        
        $words = str_word_count($message);
        if($words < 2) {
            $this->debug("Returning because $words");
            return;
        }
        
        $matches = array();
        preg_match("/^(\S+) (.*)/",$message,$matches);
        $command = $matches[1];
        $argument = $matches[2];

        if ('feed' == $command) {
            $this->handleFeed($argument);
        }
        //TODO
        // handle you -> I transformations here
    }
    
    private function handleFeed($uri)
    {
        if(strpos($uri,'http://') !== 0 ) {
            return false;
        }
        $this->debug("Feeding on $uri");
        $feeder = new Kman_Feeder_Http(($this->_brain));
        $result = $feeder->add($uri);
        if($result) {
            $this->_subject->setResponse('Mmmmm , that was good');
        } else {
            $this->_subject->setResponse('Mmmmm , there is something about ma.. uri');
        }
        return true;
        
   }
    
    private function debug($message)
    {
        Kman_Log::log($message);
    }
}
?>