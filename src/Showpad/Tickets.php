<?php

/**
 * Showpad Tickets
 *
 * Use this class to connect to the Showpad API.
 *
 * @author Jeroen Desloovere <jeroen@siesqo.be>
 */
class ShowpadTickets
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
     * Get tickets
     *
     * @param associative_array $params[optional]
     *         - fields string Comma separated list of all fields that need to be retrieved.
     *         - limit int Sets the maximum number of returned items. For example, if 'limit' is 15, only 15 items will be retrieved.
     *         - offset int Set the offset of the returned items. For example, if 'offset' is 5 and 'limit' is 10, items 6 to 15 will be returned.
     *         - status string Query for tickets with the given status
     * @return array
     */
    public function getAll($params = array())
    {
        return $this->master->doCall('tickets', $params, 'GET');
    }
}
