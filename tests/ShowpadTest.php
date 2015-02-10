<?php

namespace JeroenDesloovere\Showpad;

// required to load
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../examples/credentials.php';

/*
 * This file is part of the Showpad PHP class from Jeroen Desloovere.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use JeroenDesloovere\Showpad\Showpad;

/**
 * Showpad Class
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class ShowpadTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Showpad
     */
    private $api;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->api = new Showpad(
            SHOWPAD_USERNAME,
            SHOWPAD_API_KEY
        );
    }

    /**
     * Tear down
     */
    public function tearDown()
    {
        $this->api = null;
    }

    /**
     * Test assets object
     */
    public function testAssets()
    {
        $this->assertEquals(true, isset($this->api->assets));
    }

    /**
     * Test comments object
     */
    public function testComments()
    {
        $this->assertEquals(true, isset($this->api->comments));
    }

    /**
     * Test tags object
     */
    public function testTags()
    {
        $this->assertEquals(true, isset($this->api->tags));
    }

    /**
     * Test tickets object
     */
    public function testTickets()
    {
        $this->assertEquals(true, isset($this->api->tickets));
    }

    /**
     * Test userGroups object
     */
    public function testUserGroups()
    {
        $this->assertEquals(true, isset($this->api->userGroups));
    }

    /**
     * Test users object
     */
    public function testUsers()
    {
        $this->assertEquals(true, isset($this->api->users));
    }
}
