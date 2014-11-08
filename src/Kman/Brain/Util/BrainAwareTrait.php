<?php
/**
 * Created by PhpStorm.
 * User: cdordea
 * Date: 08/11/14
 * Time: 21:40
 */

namespace Kman\Brain\Util;

use Kman\Brain\BrainInterface;

trait BrainAwareTrait
{
    /**
     * @var BrainInterface
     */
    private $brain = null;

    /**
     * @return BrainInterface
     */
    public function getBrain()
    {
        if (!$this->brain) {
            throw new \RuntimeException("Brain is not configured \n");
        }
        return $this->brain;
    }

    /**
     * @param BrainInterface $brain
     */
    public function setBrain(BrainInterface $brain)
    {
        $this->brain = $brain;
    }
}