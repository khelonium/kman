<?php
namespace Kman\Communicator;

use Kman\Brain\BrainInterface;

interface CommunicatorInterface
{


    /**
     * Starts the communicator.
     * @return bool
     */
    public function connect();

    /**
     * Sets the 'brain'.
     * Brain may be any bot implementation.
     * If the query will not be processed by a command,
     * then , the brain will try to figure something out.
     * @param BrainInterface $brain
     */
    public function setBrain(BrainInterface $brain);

    public function addCommand(CommandInterface $command);

    /**
     * Returns a response.
     * It's you call wherever you are using the brain or not
     * @param string $query
     * @return string
     */
    public function getResponse($query);

}
