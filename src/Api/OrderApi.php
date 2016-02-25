<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 09/01/2016
 * Time: 20:32
 */

namespace Nybbl\Api;

use Nybbl\Api;

class OrderApi extends Api
{
    /**
     * OrderApi constructor.
     * @param string $endpoint
     * @param string $accessToken
     */
    public function __construct($endpoint, $accessToken)
    {
        parent::__construct($endpoint, $accessToken);
    }

    /**
     * Gets all orders matching the criteria
     *
     * @param int $restaurantId
     * @param int $status
     * @param int $page
     * @return array
     */
    public function getOrders($restaurantId, $status = 0, $page = 0)
    {
        $route = 'orders/' . $restaurantId;

        if (!is_null($status)) {
            return $this->doApiRequest($route, 'GET', ['status' => $status, 'page' => $page]);
        } else {
            return $this->doApiRequest($route);
        }
    }

    /**
     * Get a specific order by it's ID
     *
     * @param int $orderId
     * @return array
     */
    public function getOrder($orderId)
    {
        $route = 'order/' . $orderId;
        return $this->doApiRequest($route);
    }

    /**
     * Updates the order's status
     *
     * @param int $orderId
     * @param int $restaurantId
     * @param int $status
     * @return array
     */
    public function updateOrderStatus($orderId, $restaurantId, $status)
    {
        $route = 'order/' . $orderId . '/update/status';

        return $this->doApiRequest($route, 'POST', [
            'restaurant_id' => $restaurantId,
            'status' => $status,
        ]);
    }
}