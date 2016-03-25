<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 09/01/2016
 * Time: 20:19
 */

namespace Nybbl\Api;

use Nybbl\Api\Api;

/**
 * Class GeneralApi
 * @package Nybbl\Api
 */
class GeneralApi extends Api
{
    /**
     * GeneralApi constructor.
     * @param string $endpoint
     * @param string $accessToken
     */
    public function __construct($endpoint, $accessToken)
    {
        parent::__construct($endpoint, $accessToken);
    }

    /**
     * Returns data about the API
     *
     * @return array
     */
    public function getPing()
    {
        return $this->doApiRequest('/');
    }

    /**
     * Returns results relating to the search term
     *
     * @param string $query
     * @param int $restaurantId
     * @return array
     */
    public function getSearch($query, $restaurantId)
    {
        $result = $this->doApiRequest(
            'search',
            'GET',
            [
                'q' => $query,
                'restaurantId' => $restaurantId,
            ]
        );

        return $result;
    }

    /**
     * Checks if a subdomain exists
     *
     * @param string $subdomain
     * @return array
     */
    public function getSubdomain($subdomain)
    {
        $route = 'subdomain/' . $subdomain;
        return $this->doApiRequest($route);
    }

    /**
     * Gets all Nybbl domains
     *
     * @return array
     */
    public function getDomains()
    {
        return $this->doApiRequest('domains');
    }

    /**
     * Get a specific nybbl domain using the TLD or ID
     *
     * @param int|string $domainId
     * @return array
     */
    public function getDomain($domainId)
    {
        $route = 'domain/' . $domainId;
        return $this->doApiRequest($route);
    }
}