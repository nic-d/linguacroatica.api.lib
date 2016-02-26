<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 09/01/2016
 * Time: 20:19
 */

namespace Nybbl\Api;

use Nybbl\Api\Api;

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
     * Returns results relating to the search term
     *
     * @param string $query
     * @param int $restaurantId
     * @return array
     */
    public function search($query, $restaurantId)
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
    public function checkSubdomainExists($subdomain)
    {
        $route = 'subdomain/' . $subdomain;
        return $this->doApiRequest($route);
    }

    /**
     * Gets a list of nybbl domains
     *
     * @return array
     */
    public function getDomainList()
    {
        return $this->doApiRequest('domains');
    }

    /**
     * Get a specific domain using the TLD or ID
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