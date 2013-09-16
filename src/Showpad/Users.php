<?php

/**
 * Showpad Users
 *
 * Use this class to connect to the Showpad API.
 *
 * @author Jeroen Desloovere <jeroen@siesqo.be>
 */
class ShowpadUsers
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

	/**
	 * Get all users
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
	public function getAll($params = array())
	{
		return $this->master->doCall('users', $params, 'GET');
	}
}