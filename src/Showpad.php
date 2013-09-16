<?php

require_once 'Showpad/Assets.php';
require_once 'Showpad/Comments.php';
require_once 'Showpad/Tags.php';
require_once 'Showpad/Tickets.php';
require_once 'Showpad/Users.php';
require_once 'Showpad/UserGroups.php';

/**
 * Showpad
 *
 * Use this class to connect to the Showpad API.
 *
 * @author Jeroen Desloovere <jeroen@siesqo.be>
 */
class Showpad
{
	// API
	const API_URL = 'https://[username].showpad.biz/api/';
	const API_version = 'v1';

	// DEBUG
	const DEBUG = true;

	/**
	 * API key
	 *
	 * @var string
	 */
	private $apiKey;

	/**
	 * CURL
	 *
	 * @var curl
	 */
	private $ch;

	/**
	 * Username
	 *
	 * @var string
	 */
	private $username;

	/**
	 * Construct
	 *
	 * @param string $username
	 * @param string $apikey
	 */
	public function __construct($username, $apiKey)
	{
		// define credentials
		$this->username = (string) $username;
		$this->apiKey = (string) $apiKey;

		// define timeout
		$timeout = 600;

		// define curl
		$this->ch = curl_init();

		// set options for curl
		curl_setopt($this->ch, CURLOPT_HEADER, false);
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, array('ShowpadAuthorizationKey: ' . $this->apiKey));
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($this->ch, CURLOPT_USERAGENT, 'Showpad-PHP/1.0.0');
		curl_setopt($this->ch, CURLOPT_VERBOSE, self::DEBUG);
		curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($this->ch, CURLOPT_TIMEOUT, $timeout);

		// define items
		$this->assets = new ShowpadAssets($this);
		$this->comments = new ShowpadComments($this);
		$this->tags = new ShowpadTags($this);
		$this->tickets = new ShowpadTickets($this);
		$this->users = new ShowpadUsers($this);
		$this->userGroups = new ShowpadUserGroups($this);
	}

	/**
	 * Do call
	 *
	 * @param string $url
	 * @param array $params
	 */
	public function doCall($url, $params = array(), $method = 'POST')
	{
		// redefine url
		$url = str_replace('[username]', $this->username, self::API_URL) . self::API_version . '/' . $url . '.json';

		// redefine method
		$method = strtoupper($method);

		// error checking
		if(!in_array($method, array('DELETE', 'GET', 'LINK', 'POST', 'PUT', 'UNLINK')))
		{
			throw new ShowpadException('Method type not supported.');	
		}

		// set method type to GET
		if($method == 'GET')
		{
			// set to GET
			curl_setopt($this->ch, CURLOPT_HTTPGET, true);
			
			// add params to url
			if(count($params) > 0) $url .= '?' . http_build_query($params);
		}

		// set method type to POST
		elseif($method == 'POST')
		{
			curl_setopt($this->ch, CURLOPT_POST, true);
			curl_setopt($this->ch, CURLOPT_POSTFIELDS, $params);
		}

		// set method type to PUT
		elseif($method == 'PUT') curl_setopt($this->ch, CURLOPT_PUT, true);

		// set method type to EVERYTHING ELSE
		else curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, $method);

		// define curl options
		curl_setopt($this->ch, CURLOPT_URL, $url);

		// start timer
		$start = microtime(true);
		
		// starting call
		$this->log('<br/><br/>' . $method . ' Call to ' . $url . ': ' . json_encode($params));
		if(self::DEBUG) {
			$curl_buffer = fopen('php://memory', 'w+');
			curl_setopt($this->ch, CURLOPT_STDERR, $curl_buffer);
		}

		// execute curl
		$response_body = curl_exec($this->ch);

		// get more info about response
		$info = curl_getinfo($this->ch);

		// define time needed to run
		$time = microtime(true) - $start;
		if(self::DEBUG) {
			rewind($curl_buffer);
			$this->log(stream_get_contents($curl_buffer));
			fclose($curl_buffer);
		}

		// log result
		$this->log('Completed in ' . number_format($time * 1000, 2) . 'ms');
		$this->log('Got response: ' . $response_body);

		// curl error happened
		if(curl_error($this->ch))
		{
			throw new ShowpadException("API call to $url failed: " . curl_error($this->ch));
		}

		// decode result
		$result = json_decode($response_body, true);
/*
		// error checking for cast errors
		if(floor($info['http_code'] / 100) >= 4)
		{
			throw new ShowpadException('Cast error: ' . $result);
		}
*/
		// error checking
		if($result['meta']['code'] != 200)
		{
			throw new ShowpadException($result['meta']['message']);
		}

		return $result['response'];
	}

	/**
	 * Log
	 *
	 * @param string $value
	 */
	public function log($value)
	{
		if(self::DEBUG)
		{
			echo $value . '<br/><br/>';	
		}
	}
}


/**
 * Showpad Exception class
 *
 * @author Jeroen Desloovere <jeroen@siesqo.be>
 */
class ShowpadException extends Exception {}
