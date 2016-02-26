<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 09/01/2016
 * Time: 20:32
 */

namespace Nybbl\Api;

use Nybbl\Api\Api;

class AnalyticsApi extends Api
{
    /**
     * AnalyticsApi constructor.
     * @param string $endpoint
     * @param string $accessToken
     */
    public function __construct($endpoint, $accessToken)
    {
        parent::__construct($endpoint, $accessToken);
    }

    /**
     * Gets analytics data
     *
     * @param int $restaurantId
     * @return array
     */
    public function getAnalytics($restaurantId)
    {
        $route = 'analytics/' . $restaurantId;
        return $this->doApiRequest($route);
    }

    /**
     * Gets order analytics data
     *
     * @param int $restaurantId
     * @return array
     */
    public function getOrderAnalytics($restaurantId)
    {
        $route = 'analytics/orders/' . $restaurantId;
        return $this->doApiRequest($route);
    }
}