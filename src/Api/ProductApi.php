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
 * Class ProductApi
 * @package Nybbl\Api
 */
class ProductApi extends Api
{
    /**
     * ProductApi constructor.
     * @param string $endpoint
     * @param string $accessToken
     */
    public function __construct($endpoint, $accessToken)
    {
        parent::__construct($endpoint, $accessToken);
    }

    /**
     * Get all products
     *
     * @param int $restaurantId
     * @return array
     */
    public function getProducts($restaurantId)
    {
        $route = 'products/' . $restaurantId;
        return $this->doApiRequest($route);
    }

    /**
     * Get a specific product by it's ID or slug
     *
     * @param int|string $productId
     * @return array
     */
    public function getProduct($productId)
    {
        $route = 'products/' . $productId . '/single';
        return $this->doApiRequest($route);
    }

    /**
     * Creates a new product
     *
     * @param int $restaurantId
     * @param array $productData
     * @return array
     */
    public function createNewProduct($restaurantId, $productData)
    {
        $route = 'products/' . $restaurantId . '/new';
        return $this->doApiRequest($route, 'POST', $productData);
    }

    /**
     * Updates an existing product
     *
     * @param int $productId
     * @param array $productData
     * @return array
     */
    public function updateProduct($productId, $productData)
    {
        $route = 'products/' . $productId . '/update';
        return $this->doApiRequest($route, 'POST', $productData);
    }

    /**
     * Deletes a product
     *
     * @param int $restaurantId
     * @param int $productId
     * @return array
     */
    public function deleteProduct($restaurantId, $productId)
    {
        $route = 'products/' . $productId . '/delete';

        return $this->doApiRequest($route, 'POST', [
            'restaurant_id' => $restaurantId,
        ]);
    }
}