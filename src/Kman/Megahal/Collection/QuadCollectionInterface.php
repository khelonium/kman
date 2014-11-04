<?php
namespace Kman\Megahal\Collection;

use Countable;
use Kman\Megahal\Quad;

interface QuadCollectionInterface extends Countable
{
    /**
     * Checks if collection has quad.
     *
     * @param Quad $quad
     * @return bool
     */
    public function hasQuad(Quad $quad);

    /**
     * Adds quad to collection
     *
     * @param \Kman\Megahal\Quad $quad
     */
    public function add(Quad $quad);


    /**
     * Gets a quad based on a signature.
     *
     * @param string $signature
     * @return Quad|null
     */
    public function getQuad($signature);

}
