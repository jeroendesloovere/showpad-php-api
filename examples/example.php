<?php

/**
 * Showpad tests
 *
 * @author Jeroen Desloovere <jeroen@siesqo.be>
 */
// require class
require "./../src/Showpad.php";

// define credentials
$username = '';
$apiKey = '';

// redefine credentials
require "./config.ini.php";

// define api
$api = new Showpad($username, $apiKey);

/**
 * Get all tests
 */
// get users
//$items = $api->users->getAll();

// get userGgroups
//$items = $api->userGroups->getAll();

// get assets
//$items = $api->assets->getAll();

// get tags
//$items = $api->tags->getAll();

// get comments
//$items = $api->comments->getAll();

// get tickets
// $items = $api->tickets->getAll();

// print items
//print_r($items);

/**
 * Create tests
 */
// add user
$insert = $api->users->create('Jeroenie', 'Desloovere', 'test@siesqo.be', 'deslooverej', 'nl');
 
// add asset
//$insert = $api->assets->create($_SERVER['DOCUMENT_ROOT'] . '/empty-image.jpg');

// print insert
print_r($insert);
