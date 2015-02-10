<?php

/**
 * Showpad Assets
 *
 * Use this class to connect to the Showpad API.
 *
 * @author Jeroen Desloovere <jeroen@siesqo.be>
 */
class ShowpadAssets
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
     * Create asset
     * @todo
     *
     * @param string $filePath The path to the file you want to upload
     * @param string $description[optional] Custom description about the file
     * @param string $externalId[optional] string External ID of the asset as used in the source application
     * @param bool $isShareable[optional] bool Set to true if you want to allow users to share this file with other people
     * @param bool $isAnnotatable[optional] bool Set to true if you want to allow tablet users to share to annotate this file
     * @param bool $isSensitive[optional] bool Set to true if you do not want this file to be visible in Kiosk mode on the tablet
     * @return array
     */
    public function create($filePath, $description = '', $externalId = null, $isShareable = true, $isAnnotable = true, $isSensitive = true)
    {
        // init parameters
        $params = array();

        // define parameters
        $params['file'] = (string) $filePath;
        if (isset($description)) {
            $params['description'] = (string) $description;
        }
        if (isset($externalId)) {
            $params['externalId'] = (string) $externalId;
        }
        $params['isShareable'] = (bool) $isShareable;
        $params['isAnnotable'] = (bool) $isAnnotable;
        $params['isSensitive'] = (bool) $isSensitive;

        // return
        return $this->master->doCall('assets', $params);
    }

    /**
     * Get assets
     *
     * @param associative_array $params[optional]
     *         - fields string Comma separated list of all fields that need to be retrieved.
     *         - limit int Sets the maximum number of returned items. For example, if 'limit' is 15, only 15 items will be retrieved.
     *         - offset int Set the offset of the returned items. For example, if 'offset' is 5 and 'limit' is 10, items 6 to 15 will be returned.
     *         - name string Query for asset with the given name
     *         - originalName string Query for asset with the given original name
     *         - filetype string Possible values are: 'audio', 'template', 'customization', 'document', 'photo', 'pricelist', 'video'
     *         - isSensitive bool Query for assets by sensitivity status
     *         - isShareable bool Query for assets by shareability status
     *         - isAnnotatable bool Query for assets by annotatability status
     *         - externalId string Query for assets by external ID
     * @return array
     */
    public function getAll($params = array())
    {
        return $this->master->doCall('assets', $params, 'GET');
    }
}
