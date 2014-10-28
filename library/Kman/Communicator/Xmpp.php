<?php
class Kman_Communicator_Xmpp extends Kman_Communicator_Abstract
{

    /**
     * Xmpp conn object.
     *
     * @var Xmpp
     */
    private $_xmpp = null;
    
    public function __construct($host, $port, $user, $password, $resource, $server= null)
    {
        parent::__construct();
        $this->_xmpp = new Xmpp($host, $port, $user, $password, $resource, $server, true , $loglevel=Xmpp_Logging::LOGGING_INFO);    
    }
    /**
     * Starts the communicator.
     * @return bool
     */
    public function connect()
    {
        $this->_xmpp->connect();
        $this->process();
    }
    
    
    private function process()
    {
        
        $conn = $this->_xmpp;
        while(!$conn->disconnected) {
        	$payloads = $conn->processUntil(array('message', 'presence', 'end_stream', 'session_start'));
        	foreach($payloads as $event) {
        	    $this->handleEvent($event);
        	}
        }
    }
    
    private function handleEvent($event)
    {
        $pl = $event[1];
        $event_type = $event[0];
        $conn = $this->_xmpp;
		switch($event_type) {
			case 'message': 
				print "---------------------------------------------------------------------------------\n";
				print "Message from: {$pl['from']}\n";
				
				if(array_key_exists('subject',$pl)) print "Subject: {$pl['subject']}\n";
				print $pl['body'] . "\n";
				print "---------------------------------------------------------------------------------\n";
				
                $type    = $pl['type'];
                $from    = $pl['from'];
                $message = $pl['body'];
                
                $response = $this->getResponse($message);
                
			    if($response) {
                    $conn->message($from , $response, $type);
			    }				    
				
				if($pl['body'] == 'quit') $conn->disconnect();
				if($pl['body'] == 'break') $conn->send("</end>");
			break;
			case 'presence':
				print "Presence: {$pl['from']} [{$pl['show']}] {$pl['status']}\n";
			break;
			case 'session_start':
				$conn->presence($status="Cheese!");
			break;
		}
    }
    
    private function handleMessage($message ,$from)
    {
        if($message == null) {
            return null;
        }
        $brain = $this->getBrain();
        if($brain == null) {
         return "You sent : $message";
        }
        $brain->add($message);
        return $brain->getSentence(Kman_Lexic_Term_Extractor::extract($message));
    }
    
}
