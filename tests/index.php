<?php

/**
 * Showpad tests
 *
 * @author Jeroen Desloovere <jeroen@siesqo.be>
 */
// require class
require "./../showpad.php";
require "./config.ini.php";

// define api
$api = new Showpad($username, $apiKey);

// get users
//$items = $api->getUsers();

// get userGgroups
//$items = $api->getUserGroups();

// get assets
//$items = $api->getAssets();

// get tags
//$items = $api->getTags();

// get comments
//$items = $api->getComments();

// get tickets
$items = $api->getTickets();

// print items
print_r($items);
