<?php

/**
 * Showpad
 *
 * Use this class to connect to the Showpad API.
 *
 * @author Jeroen Desloovere <jeroen@siesqo.be>
 */
class Showpad
{
	// API URL
	const API_URL = 'https://[username].showpad.biz/api/';
	const API_version = 'v1';
	const DEBUG = false;

	/**
	 * API key
	 *
	 * @var string
	 */
	private $apiKey;

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
		$this->username = (string) $username;
		$this->apiKey = (string) $apiKey;
	}

	/**
	 * Do call
	 *
	 * @param string $url
	 * @param array $params
	 */
	private function doCall($url, $params = array(), $method = 'POST')
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
		
		// define timeout
		$timeout = 600;

		// create curl
		$ch = curl_init();

		// define curl options
		curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($params));
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('ShowpadAuthorizationKey: ' . $this->apiKey));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Showpad-PHP/1.0.0');
		curl_setopt($ch, CURLOPT_VERBOSE, self::$DEBUG);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_TIMEOUT, $opts['timeout']);

		// set method type
		if($method == 'GET') curl_setopt($ch, CURLOPT_HTTPGET, true);
		elseif($method == 'POST') curl_setopt($ch, CURLOPT_POST, true);
		elseif($method == 'PUT') curl_setopt($ch, CURLOPT_PUT, true);
		else curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

		$start = microtime(true);
		$this->log('Call to ' . $url . ': ' . $params);
		if(self::$DEBUG) {
			$curl_buffer = fopen('php://memory', 'w+');
			curl_setopt($ch, CURLOPT_STDERR, $curl_buffer);
		}

		$response_body = curl_exec($ch);
		$info = curl_getinfo($ch);
		$time = microtime(true) - $start;
		if(self::$DEBUG) {
			rewind($curl_buffer);
			$this->log(stream_get_contents($curl_buffer));
			fclose($curl_buffer);
		}

		$this->log('Completed in ' . number_format($time * 1000, 2) . 'ms');
		$this->log('Got response: ' . $response_body);

		if(curl_error($ch)) {
			throw new ShowpadException("API call to $url failed: " . curl_error($ch));
		}
		$result = json_decode($response_body, true);

		if(floor($info['http_code'] / 100) >= 4) {
			throw $this->castError($result);
		}
		
		// error checking
		if($result['meta']['code'] != 200)
		{
			throw new ShowpadException($result['meta']['message']);
		}

		return $result['response'];
	}

	/**
	 * Get assets
	 *
	 * @param associative_array $params[optional]
	 * 		- fields string Comma separated list of all fields that need to be retrieved.
	 * 		- limit int Sets the maximum number of returned items. For example, if 'limit' is 15, only 15 items will be retrieved.
	 * 		- offset int Set the offset of the returned items. For example, if 'offset' is 5 and 'limit' is 10, items 6 to 15 will be returned.
	 * 		- name string Query for asset with the given name
	 * 		- originalName string Query for asset with the given original name
	 * 		- filetype string Possible values are: 'audio', 'template', 'customization', 'document', 'photo', 'pricelist', 'video'
	 * 		- isSensitive bool Query for assets by sensitivity status
	 * 		- isShareable bool Query for assets by shareability status
	 * 		- isAnnotatable bool Query for assets by annotatability status
	 * 		- externalId string Query for assets by external ID
	 * @return array
	 */
	public function getAssets($params = array())
	{
		return $this->doCall('assets', $params, 'GET');
	}

	/**
	 * Get comments
	 *
	 * @param associative_array $params[optional]
	 * 		- fields string Comma separated list of all fields that need to be retrieved.
	 * 		- limit int Sets the maximum number of returned items. For example, if 'limit' is 15, only 15 items will be retrieved.
	 * 		- offset int Set the offset of the returned items. For example, if 'offset' is 5 and 'limit' is 10, items 6 to 15 will be returned.
	 * 		- externalId string Query for comments with the given external Id
	 * 		- isUnregisteredUserComment bool Query for comments created by or not created by an unregistered user
	 * 		- unregisteredUserFirstName string Query for the first name of an unregistered user
	 * 		- unregisteredUserLastName string Query for the last name of an unregistered user	
	 * @return array
	 */
	public function getComments($params = array())
	{
		return $this->doCall('comments', $params, 'GET');
	}

	/**
	 * Get tags
	 *
	 * @param associative_array $params[optional]
	 * 		- fields string Comma separated list of all fields that need to be retrieved.
	 * 		- limit int Sets the maximum number of returned items. For example, if 'limit' is 15, only 15 items will be retrieved.
	 * 		- offset int Set the offset of the returned items. For example, if 'offset' is 5 and 'limit' is 10, items 6 to 15 will be returned.
	 * 		- name string Query for tags with the given name
	 * 		- externalId string Query for tags with the given external Id
	 * @return array
	 */
	public function getTags($params = array())
	{
		return $this->doCall('tags', $params, 'GET');
	}

	/**
	 * Get tickets
	 *
	 * @param associative_array $params[optional]
	 * 		- fields string Comma separated list of all fields that need to be retrieved.
	 * 		- limit int Sets the maximum number of returned items. For example, if 'limit' is 15, only 15 items will be retrieved.
	 * 		- offset int Set the offset of the returned items. For example, if 'offset' is 5 and 'limit' is 10, items 6 to 15 will be returned.
	 * 		- status string Query for tickets with the given status
	 * @return array
	 */
	public function getTickets($params = array())
	{
		return $this->doCall('tickets', $params, 'GET');
	}

	/**
	 * Get users
	 *
	 * @param associative_array $params[optional]
	 * 		- fields string Comma separated list of all fields that need to be retrieved.
	 * 		- limit int Sets the maximum number of returned items. For example, if 'limit' is 15, only 15 items will be retrieved.
	 * 		- offset int Set the offset of the returned items. For example, if 'offset' is 5 and 'limit' is 10, items 6 to 15 will be returned.
	 *		- firstName string Query for users with a given first name
	 *		- lastName string Query for users with a given last name
	 *		- email string Query for users with a given email address
	 *		- userName string Query for users with a given username
	 *		- language string Query for users with a given language
	 *		- userType string Possible values: 'owner' or 'tablet'
	 *		- externalId string Query for users with a given external user id
	 *		- isActive bool Query for usergroups with the given external Id
	 * @return array
	 */
	public function getUsers($params = array())
	{
		return $this->doCall('users', $params, 'GET');
	}

	/**
	 * Get user groups
	 *
	 * @param associative_array $params[optional]
	 * 		- fields string Comma separated list of all fields that need to be retrieved.
	 * 		- limit int Sets the maximum number of returned items. For example, if 'limit' is 15, only 15 items will be retrieved.
	 * 		- offset int Set the offset of the returned items. For example, if 'offset' is 5 and 'limit' is 10, items 6 to 15 will be returned.
	 * 		- userGroup string Query for usergroups with the given name
	 * 		- externalId string Query for usergroups with the given external Id
	 * @return array
	 */
	public function getUserGroups($params = array())
	{
		return $this->doCall('usergroups', $params, 'GET');
	}

	/**
	 * Log
	 *
	 * @param string $value
	 */
	public function log($value)
	{
		if(self::$DEBUG)
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
class ShowpadException extends Exception
{
}
