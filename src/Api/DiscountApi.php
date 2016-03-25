<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 09/01/2016
 * Time: 20:16
 */

namespace Nybbl\Api;

use Nybbl\Api\Api;

/**
 * Class DiscountApi
 * @package Nybbl\Api
 */
class DiscountApi extends Api
{
    /**
     * DiscountApi constructor.
     * @param $endpoint
     * @param $accessToken
     */
    public function __construct($endpoint, $accessToken)
    {
        parent::__construct($endpoint, $accessToken);
    }

    /**
     * Gets a specific discount
     *
     * @param int $discountId
     * @return array
     */
    public function getDiscount($discountId)
    {
        $route = 'discount/' . $discountId;
        return $this->doApiRequest($route);
    }

    /**
     * Gets all discounts
     *
     * @param int $restaurantId
     * @return array
     */
    public function getDiscounts($restaurantId)
    {
        $route = 'discount/' . $restaurantId . '/all';
        return $this->doApiRequest($route);
    }

    /**
     * Creates a new discount
     *
     * @param int $restaurantId
     * @param array $discountData
     * @return array
     */
    public function createNewDiscount($restaurantId, $discountData)
    {
        $route = 'discount/' . $restaurantId . '/new';
        return $this->doApiRequest($route, 'POST', $discountData);
    }

    /**
     * Deletes a discount
     *
     * @param int $restaurantId
     * @param int $discountId
     * @return array
     */
    public function deleteDiscount($restaurantId, $discountId)
    {
        $route = 'discount/' . $discountId . '/delete';

        return $this->doApiRequest($route, 'POST', [
            'restaurant_id' => $restaurantId,
        ]);
    }
}