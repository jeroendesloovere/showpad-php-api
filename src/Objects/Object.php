<?php

namespace JeroenDesloovere\Showpad\Objects;

/*
 * This file is part of the Showpad PHP API connection class from Jeroen Desloovere.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use JeroenDesloovere\Showpad\Showpad;

/**
 * Showpad Object
 *
 * This class is the core for every object.
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class Object
{
    /**
     * Construct
     *
     * @param Showpad $master
     */
    public function __construct(Showpad $master)
    {
        $this->master = $master;
    }
}
