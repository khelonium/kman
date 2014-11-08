<?php
namespace Kman\Communicator;


class Cli extends AbstractCommunicator
{

    public function connect()
    {
        $handler = fopen("php://stdin", "r");
        $message = "Hello";
        $this->send("\n  I am Kman with a rudimentary Megahal brain");
        $bye = null;

        while ($message != $bye) {
            echo "you>";
            $message = fgets($handler);
            $message = str_replace("\n", "", $message);

            foreach ($this->getResponse($message) as $response) {
                $this->send($response);
            }

        }
    }

    protected function send($message)
    {
        echo 'kman>', $message, "\n";
    }
}