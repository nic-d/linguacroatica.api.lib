<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 16/01/2016
 * Time: 15:39
 */

namespace Nybbl\Api;

use Nybbl\Api;

class CustomerApi extends Api
{
    /**
     * CustomerApi constructor.
     * @param $endpoint
     * @param $accessToken
     */
    public function __construct($endpoint, $accessToken)
    {
        parent::__construct($endpoint, $accessToken);
    }

    /**
     * Gets all of the restaurant's customers
     *
     * @param int $restaurantId
     * @return array
     */
    public function getAllCustomers($restaurantId)
    {
        $route = 'customer/' . $restaurantId . '/all';
        return $this->doApiRequest($route);
    }

    /**
     * Gets a single customer
     *
     * @param int $customerId
     * @return array
     */
    public function getCustomer($customerId)
    {
        $route = 'customer/' . $customerId;
        return $this->doApiRequest($route);
    }

    /**
     * Creates a new customer
     *
     * @param int $restaurantId
     * @param array $customerData
     * @return array
     */
    public function newCustomer($restaurantId, $customerData)
    {
        $route = 'customer/' . $restaurantId . '/new';
        return $this->doApiRequest($route, 'POST', $customerData);
    }

    /**
     * Updates a customer
     *
     * @param int $customerId
     * @param array $customerData
     * @return array
     */
    public function updateCustomer($customerId, $customerData)
    {
        $route = 'customer/' . $customerId . '/update';
        return $this->doApiRequest($route, 'POST', $customerData);
    }

    /**
     * Deletes a customer
     *
     * @param int $customerId
     * @return array
     */
    public function deleteCustomer($customerId)
    {
        $route = 'customer/' . $customerId . '/delete';
        return $this->doApiRequest($route, 'POST');
    }
}