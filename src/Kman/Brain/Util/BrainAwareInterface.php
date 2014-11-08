<?php
/**
 * Created by PhpStorm.
 * User: cdordea
 * Date: 08/11/14
 * Time: 21:42
 */

namespace Kman\Brain\Util;


use Kman\Brain\BrainInterface;

interface BrainAwareInterface
{
    public function setBrain(BrainInterface $brain);

    /**
     * @return BrainInterface
     */
    public function getBrain();
} 