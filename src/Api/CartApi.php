<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 07/04/2016
 * Time: 16:50
 */

namespace Nybbl\Api;

use Nybbl\Api\Api;

/**
 * Class CartApi
 * @package Nybbl\Api
 */
class CartApi extends Api
{
    /**
     * CartApi constructor.
     * @param string $endpoint
     * @param string $accessToken
     */
    public function __construct($endpoint, $accessToken)
    {
        parent::__construct($endpoint, $accessToken);
    }

    /**
     * Gets the cart data if it exists.
     *
     * @param string $id
     * @return array
     */
    public function get($id)
    {
        $route = '/cart/' . $id;
        return $this->doApiRequest($route);
    }

    /**
     * Adds a product to the cart.
     *
     * @param array $data
     * @return array
     */
    public function add($data)
    {
        $route = '/cart/add';
        return $this->doApiRequest($route, 'POST', $data);
    }

    /**
     * Adds a product with modifiers to the cart.
     *
     * @param array $data
     * @return array
     */
    public function addModifier($data)
    {
        $route = '/cart/add/modifier';
        return $this->doApiRequest($route, 'POST', $data);
    }

    /**
     * Removes a product from the cart.
     *
     * @param array $data
     * @return array
     */
    public function remove($data)
    {
        $route = '/cart/remove';
        return $this->doApiRequest($route, 'POST', $data);
    }

    /**
     * Removes a modifier from the cart.
     *
     * @param array $data
     * @return array
     */
    public function removeModifier($data)
    {
        $route = '/cart/remove/modifier';
        return $this->doApiRequest($route, 'POST', $data);
    }
}