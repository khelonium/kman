<?php
/**
 * Created by PhpStorm.
 * User: cdordea
 * Date: 08/11/14
 * Time: 02:31
 */

namespace Kman\Communicator\Command;


use Kman\Communicator\CommandInterface;

class Uptime implements CommandInterface
{
    private $start = null;

    public function __construct()
    {
        $this->start = time();
    }

    public function matches($message)
    {

        return $message == 'uptime';
    }

    public function execute($message)
    {
            $time = time();
            $diff = $time - $this->start;
            return number_format($diff / 60, 2) . " minutes";
    }
}