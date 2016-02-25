<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 09/01/2016
 * Time: 20:32
 */

namespace Nybbl\Api;

use Nybbl\Api;

class TeamApi extends Api
{
    /**
     * TeamApi constructor.
     * @param string $endpoint
     * @param string $accessToken
     */
    public function __construct($endpoint, $accessToken)
    {
        parent::__construct($endpoint, $accessToken);
    }

    /**
     * Gets a restaurant's team
     *
     * @param int|string $restaurantId
     * @return array
     */
    public function getTeam($restaurantId)
    {
        $route = 'team/' . $restaurantId;
        return $this->doApiRequest($route);
    }
}