<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 09/01/2016
 * Time: 20:34
 */

namespace Nybbl\Api;

use Nybbl\Api\Api;

class RestaurantApi extends Api
{
    /**
     * RestaurantApi constructor.
     * @param string $endpoint
     * @param string $accessToken
     */
    public function __construct($endpoint, $accessToken)
    {
        parent::__construct($endpoint, $accessToken);
    }

    /**
     * Gets the restaurant's current settings
     *
     * @param int $restaurantId
     * @return array
     */
    public function getRestaurantSettings($restaurantId)
    {
        $route = 'restaurant/' . $restaurantId . '/settings';
        return $this->doApiRequest($route);
    }

    /**
     * Updates the restaurant's general settings
     *
     * @param int $restaurantId
     * @param array $updateData
     * @return array
     */
    public function updateRestaurantSettings($restaurantId, $updateData)
    {
        $route = 'restaurant/' . $restaurantId . '/update';
        return $this->doApiRequest($route, 'POST', $updateData);
    }

    /**
     * Updates the restaurant's storefront settings
     *
     * @param int $restaurantId
     * @param array $updateData
     * @return array
     */
    public function updateRestaurantStorefrontSettings($restaurantId, $updateData)
    {
        $route = '/restaurant/' . $restaurantId . '/update/storefront';
        return $this->doApiRequest($route, 'POST', $updateData);
    }

    /**
     * Updates the restaurant's payment settings
     *
     * @param int $restaurantId
     * @param array $updateData
     * @return array
     */
    public function updateRestaurantPaymentSettings($restaurantId, $updateData)
    {
        $route = '/restaurant/' . $restaurantId . '/update/payment';
        return $this->doApiRequest($route, 'POST', $updateData);
    }

    /**
     * Updates the restaurant's stripe customer Id
     *
     * @param int $restaurantId
     * @param string $stripeCustomerId
     * @return array
     */
    public function updateRestaurantStripeCustomerId($restaurantId, $stripeCustomerId)
    {
        $route = 'restaurant/' . $restaurantId . '/update/stripe-customer';
        return $this->doApiRequest($route, 'POST', ['stripe_customer_id' => $stripeCustomerId]);
    }

    /**
     * Gets all of the activity logged by the restaurant's team
     *
     * @param int $restaurantId
     * @param int|null $page
     * @return array
     */
    public function getRestaurantActivity($restaurantId, $page = null)
    {
        $route = 'restaurant/' . $restaurantId . '/activity';

        if (!is_null($page)) {
            return $this->doApiRequest($route, 'GET', ['page' => $page]);
        }

        return $this->doApiRequest($route);
    }
}