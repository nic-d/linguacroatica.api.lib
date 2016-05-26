<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 16/01/2016
 * Time: 15:39
 */

namespace Nybbl\Api;

use Nybbl\Api\Api;

/**
 * Class CustomerApi
 * @package Nybbl\Api
 */
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
    public function getCustomers($restaurantId)
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
     * Gets the customer's orders.
     *
     * @param int $customerId
     * @param int $page
     * @return array
     */
    public function getOrders($customerId, $page)
    {
        $route = 'customer/' . $customerId . '/orders';
        return $this->doApiRequest($route, 'GET', [
            'page' => $page,
        ]);
    }

    /**
     * Logs the customer in.
     *
     * @param int $restaurantId
     * @param string $username
     * @param string $password
     * @return array
     */
    public function login($restaurantId, $username, $password)
    {
        $route = 'customer/' . $restaurantId . '/login';
        return $this->doApiRequest($route, 'POST', [
            'username' => $username,
            'password' => $password,
        ]);
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

    /**
     * Gets a wallet item.
     *
     * @param int|string $walletId
     * @return array
     */
    public function getWalletItem($walletId)
    {
        $route = 'customer/wallet/' . $walletId;
        return $this->doApiRequest($route, 'GET');
    }

    /**
     * Creates a new wallet item.
     *
     * @param int $customerId
     * @param array $walletData
     * @return array
     */
    public function newWalletItem($customerId, $walletData)
    {
        $route = 'customer/wallet/' . $customerId . '/new';
        return $this->doApiRequest($route, 'POST', $walletData);
    }

    /**
     * Updates a wallet item.
     *
     * @param int $walletId
     * @param array $walletData
     * @return array
     */
    public function updateWalletItem($walletId, $walletData)
    {
        $route = 'customer/wallet/' . $walletId . '/update';
        return $this->doApiRequest($route, 'POST', $walletData);
    }

    /**
     * Deletes a wallet item.
     *
     * @param int $walletId
     * @return array
     */
    public function deleteWalletItem($walletId)
    {
        $route = 'customer/wallet/' . $walletId . '/delete';
        return $this->doApiRequest($route, 'POST');
    }
}