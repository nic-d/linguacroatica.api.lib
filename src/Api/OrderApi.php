<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 09/01/2016
 * Time: 20:32
 */

namespace Nybbl\Api;

use Nybbl\Api\Api;

/**
 * Class OrderApi
 * @package Nybbl\Api
 */
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
     * @param string $order
     * @return array
     */
    public function getOrders($restaurantId, $status = 0, $page = 0, $order = 'DESC')
    {
        $route = 'orders/' . $restaurantId;

        if (!is_null($status)) {
            return $this->doApiRequest($route, 'GET', ['status' => $status, 'page' => $page, 'order' => $order]);
        } else {
            return $this->doApiRequest($route);
        }
    }

    /**
     * Gets all of the orders for datatables
     *
     * @param int $restaurantId
     * @param array $params
     * @return array
     */
    public function getOrdersDatatable($restaurantId, $params)
    {
        $route = 'orders/' . $restaurantId . '/datatables';
        return $this->doApiRequest($route, 'GET', $params);
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
     * Creates a new order.
     *
     * @param int $restaurantId
     * @param array $orderData
     * @return array
     */
    public function newOrder($restaurantId, $orderData)
    {
        $route = 'order/' . $restaurantId . '/new';
        return $this->doApiRequest($route, 'POST', $orderData);
    }

    /**
     * Updates the order data
     *
     * @param int $orderId
     * @param array $updateData
     * @return array
     */
    public function updateOrder($orderId, $updateData)
    {
        $route = 'order/' . $orderId . '/update';
        return $this->doApiRequest($route, 'POST', $updateData);
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

    /**
     * Archive or Unarchive an order
     *
     * @param int $orderId
     * @param array $archiveData
     * @return array
     */
    public function archiveOrder($orderId, $archiveData)
    {
        $route = 'order/' . $orderId . '/archive';
        return $this->doApiRequest($route, 'POST', $archiveData);
    }
}