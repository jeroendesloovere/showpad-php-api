<?php

namespace JeroenDesloovere\Showpad;

// required to load
require_once __DIR__ . '/../vendor/autoload.php';

/*
 * This file is part of the Showpad PHP class from Jeroen Desloovere.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use JeroenDesloovere\Showpad\Exception;

/**
 * Exception Class
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class ExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Exception
     */
    public function testException()
    {
        throw new Exception('error');
    }
}
