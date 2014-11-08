<?php
/**
 * Created by PhpStorm.
 * User: cdordea
 * Date: 08/11/14
 * Time: 02:21
 */

namespace Kman\Communicator;


interface CommandInterface
{
    /**
     *
     * Executes the actions associated with the command
     * @return string
     */
    public function execute($message);

    /**
     * detects if the $input is of interest to the command, so that other entities
     * can decide if the command is executed or not
     * @param $input
     * @return bool
     */
    public function matches($message);


}