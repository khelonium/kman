<?php
namespace Kman\Feeder;

use Exception;

class Text
{
    public static $END_CHARS = "^.!?";

    /**
     * Holds brain instance.
     *
     * @var \Kman\Megahal\Brain
     */

    private $brain = null;

    /**
     * Constructor.
     *
     * @param Brain $brain
     */
    public function __construct($brain = null)
    {
        $this->setBrain($brain);
    }

    /**
     * Sets the brain
     *
     * @param Brain $brain
     */
    public function setBrain($brain)
    {
        $this->brain = $brain;
    }


    private function checkBrainInPlace()
    {
        if (null == $this->brain) {
            throw new Exception("Brain not in place.");
        }
    }

    /**
     * Adds an entire documents to the 'brain'.  Useful for feeding in
     * stray theses, but be careful not to put too much in, or you may
     * run out of memory!
     * @param string $uri the stream location , accesible to php
     */
    public function add($uri)
    {
        $this->checkBrainInPlace();
//        $content  = file_get_contents($uri);

        $handler = fopen($uri, "r");
        $buffer = "";
        while (($ch = fgetc($handler)) !== false) {
            $buffer .= $ch;
            if (strpos(self::$END_CHARS, $ch) > 0) {
                $this->addBuffer($buffer);
                $buffer = "";
            }
        }

        $this->addBuffer($buffer);

    }

    /**
     * Ads a buffer of data to the brain.
     * It also performs necessary strings operations.
     * @param string $buffer
     */
    private function addBuffer($buffer)
    {
        if (strlen($buffer) == 0) {
            return;
        }
        $sentence = $buffer;
        $sentence = str_replace("\r", " ", $sentence);
        $sentence = str_replace("\n", " ", $sentence);
        $this->brain->add($sentence);
    }

}

?>