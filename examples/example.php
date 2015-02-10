<?php

/*
 * This file is part of the Showpad PHP API connection class from Jeroen Desloovere.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

// required to load
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/credentials.php';

// init Showpad API
$api = new Showpad(
    SHOWPAD_USERNAME,
    SHOWPAD_API_KEY
);

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
$insert = $api->users->create(
    'Jeroenie',
    'Desloovere',
    'info@jeroendesloovere.be',
    'desloovere_j',
    'nl'
);
 
// add asset
//$insert = $api->assets->create($_SERVER['DOCUMENT_ROOT'] . '/empty-image.jpg');

// print insert
print_r($insert);
