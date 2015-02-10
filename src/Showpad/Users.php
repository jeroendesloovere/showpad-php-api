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
     * Create user
     *
     * @param string $firstName First name of the user
     * @param string $lastName Last name of the user
     * @param string $email Email of the user
     * @param string $userName Unique name of the user within the organisation
     * @param string $language The user's language
     * @param string $userType[optional] Type of user, possibilities: 'owner', 'tablet' or 'admin'
     * @param string $isActive[optional] Indicates whether a user is active
     * @param string $password[optional] Password of the user (If no password is set, an invitation mail will be sent unless specified not to)
     * @param string $externalId[optional] External ID of the user as used in the source application
     * @param string $sendMailToUser[optional] Notify the user about this update
     * @return array
     */
    public function create($firstName, $lastName, $email, $userName, $language,
        $userType = 'tablet', $isActive = true, $password = null, $externalId = null, $sendMailToUser = false)
    {
        // init parameters
        $params = array();

        // define parameters
        $params['firstName'] = (string) $firstName;
        $params['lastName'] = (string) $lastName;
        $params['email'] = (string) $email;
        $params['userName'] = (string) $userName;
        $params['language'] = (string) $language;
        $params['userType'] = (string) $userType;
        $params['isActive'] = (bool) $isActive;
        if (isset($password)) {
            $params['password'] = (string) $password;
        }
        if (isset($externalId)) {
            $params['externalId'] = (string) $externalId;
        }
        $params['sendMailToUser'] = (bool) $sendMailToUser;

        // return
        return $this->master->doCall('users', $params);
    }

    /**
     * Get all users
     *
     * @param associative_array $params[optional]
     *         - fields string Comma separated list of all fields that need to be retrieved.
     *         - limit int Sets the maximum number of returned items. For example, if 'limit' is 15, only 15 items will be retrieved.
     *         - offset int Set the offset of the returned items. For example, if 'offset' is 5 and 'limit' is 10, items 6 to 15 will be returned.
     *        - firstName string Query for users with a given first name
     *        - lastName string Query for users with a given last name
     *        - email string Query for users with a given email address
     *        - userName string Query for users with a given username
     *        - language string Query for users with a given language
     *        - userType string Possible values: 'owner' or 'tablet'
     *        - externalId string Query for users with a given external user id
     *        - isActive bool Query for usergroups with the given external Id
     * @return array
     */
    public function getAll($params = array())
    {
        return $this->master->doCall('users', $params, 'GET');
    }
}
