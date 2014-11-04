<?php
namespace Kman\Feeder;

use Kman\Megahal\Brain;
use Kman\Feeder\Uri;

/**
 * Feeds Kman with documents.
 * @author khelo
 */
class Feeder
{
    /**
     * Holds the brain that needs information.
     *
     * @var \Kman\Megahal\Brain
     */
    private $brain = null;

    public function __construct($brain)
    {
        $this->setBrain($brain);
    }

    /**
     * Sets the brain.
     *
     * @param \Kman\Megahal\Brain $brain
     */
    public function setBrain($brain)
    {
        $this->brain = $brain;
    }

    /**
     * Feeds the brain with a document.
     *
     * @param string $uri
     */
    public function addDocument($uri)
    {
        $parser = new Uri($this->brain);
        $parser->add($uri);
        unset($document);
    }
}