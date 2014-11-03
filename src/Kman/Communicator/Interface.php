<?php
interface Kman_Communicator_Interface
{
    

    /**
     * Starts the communicator.
     * @return bool
     */
    public function connect();
    
    /**
     * Sets the 'brain'.
     * Brain may be any bot implementation , 
     * at the moment Kman_Megahal.
     * @param Kman_Megahal $brain
     */
    public function setBrain(Kman_Brain_Interface $brain);
    
    
    public function addCommand($command);
    
    /**
     * Returns a response.
     * It's you call wherever you are using the brain or not
     * @param string $response
     * @return string
     */
    public function getResponse($response);

}
?>