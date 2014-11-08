<?php
namespace Kman\Communicator;

use Kman\Brain\BrainInterface;
use Kman\Communicator\Command\Bus;
use Kman\Lexic\Term\Term;

abstract class AbstractCommunicator implements CommunicatorInterface
{
    private $_brain;

    public function __construct()
    {
        $this->_commandHolder = new Bus();
    }

    private $_commandHolder = null;


    /**
     * Sets the 'brain'.
     * Brain may be any bot implementation ,
     * at the moment Kman_Megahal.
     * @param \Kman\Megahal\Brain $brain
     */
    public function setBrain(BrainInterface $brain)
    {
        $this->_brain = $brain;
    }

    /**
     * Returns the brain
     *
     * @return BrainInterface
     */
    protected function getBrain()
    {
        return $this->_brain;
    }


    public function addCommand(CommandInterface $command)
    {
            $this->_commandHolder->attach($command);
    }


    protected function getBusMessages($message)
    {
        if ($message == '') {
            return [];
        }

        return $this->_commandHolder->handle($message);
    }

    /**
     * Call this function to receive a message from the brain
     * or from the commands.
     *
     * @param string $message
     * @return array
     */
    public function getResponse($message)
    {
        if ($message == '') {
            return [];
        }

        $brain = $this->getBrain();

        $response = $this->getBusMessages($message);

        return count($response) == 0? [$this->getFromBrain($message, $brain)] :$response;

    }

    protected function extractTerm($message)
    {
        return Term::extract($message);
    }

    /**
     * @param $message
     * @param $brain
     * @return mixed
     */
    private function getFromBrain($message, $brain)
    {
        $brain->add($message);
        $term = $this->extractTerm($message);
        $response = $brain->getSentence($term);
        return $response;
    }


}
