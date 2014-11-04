<?php
namespace Kman\Communicator\Command;

use SplObserver;
use SplSubject;

class Holder implements SplSubject
{

    private $_commands = array();

    private $_message = null;

    private $_response = null;


    /**
     * Sets next message.
     *
     * @param mixed $message
     */
    public function setResponse($message)
    {
        $this->_response = trim($message);
    }


    public function getResponse()
    {
        $resp = $this->_response;
        $this->_response = null;
        return $resp;
    }

    public function getMessage()
    {
        return $this->_message;
    }

    public function setMessage($message)
    {
        $this->_message = $message;
        $this->notify();
        $this->_message = null;
    }

    public function attach(SplObserver $observer)
    {
        $this->_commands[] = $observer;
    }

    public function detach(SplObserver $observer)
    {

    }

    public function notify()
    {
        foreach ($this->_commands as $observer) {
            $observer->update($this);
        }
    }


}

?>