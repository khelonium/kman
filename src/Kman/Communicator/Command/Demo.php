<?php
class Kman_Communicator_Command_Demo implements SplObserver 
{
    public function update(SplSubject $subject)
    {
        $message = $subject->getMessage();
        if(is_int(strpos($message,'khelo'))) { 
            $subject->setResponse('The word khelo is sacred here');    
        }
        
    }
}
