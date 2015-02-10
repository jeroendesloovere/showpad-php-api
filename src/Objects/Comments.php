<?php

namespace JeroenDesloovere\Showpad\Objects;

/*
 * This file is part of the Showpad PHP API connection class from Jeroen Desloovere.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use JeroenDesloovere\Showpad\Objects\Object;

/**
 * Showpad Comments
 *
 * Use this class to connect to the Showpad API.
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class Comments extends Object
{
    /**
     * Get comments
     *
     * @param associative_array $params[optional]
     *         - fields string Comma separated list of all fields that need to be retrieved.
     *         - limit int Sets the maximum number of returned items. For example, if 'limit' is 15, only 15 items will be retrieved.
     *         - offset int Set the offset of the returned items. For example, if 'offset' is 5 and 'limit' is 10, items 6 to 15 will be returned.
     *         - externalId string Query for comments with the given external Id
     *         - isUnregisteredUserComment bool Query for comments created by or not created by an unregistered user
     *         - unregisteredUserFirstName string Query for the first name of an unregistered user
     *         - unregisteredUserLastName string Query for the last name of an unregistered user
     * @return array
     */
    public function getAll($params = array())
    {
        return $this->master->doCall('comments', $params, 'GET');
    }
}
