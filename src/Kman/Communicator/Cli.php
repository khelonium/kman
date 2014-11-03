<?php
class Cli extends AbstractCommunicator
{
    
    public function connect()
    {
        $handler = fopen("php://stdin","r");
        $message = "Hello";
        $brain   = $this->getBrain();
        echo "\nPhp Megahal \n";
        $bye     = null;
        while ($message != $bye) {
            echo "you>";
            $message  = fgets($handler);
            $message  = str_replace("\n","",$message);
            
            
            $response = $this->getResponse($message);
            
            if($response) {
                $this->send($response);
            } else {
                $this->send('moo moo baa baa , me stupid');
            }
            
        }
    }
    
    protected function send($message)
    {
        echo 'kman>',$message , "\n";
    }
}
?>