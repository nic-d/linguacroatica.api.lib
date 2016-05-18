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
    // Product modifier variant types
    CONST MODIFIER_VARIANT_EXTRA = 0;
    CONST MODIFIER_VARIANT_SIDE  = 1;

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
     * @param string $type - Either 'slug' OR 'id'.
     * @return array
     */
    public function getProduct($productId, $type = 'slug')
    {
        $route = 'products/' . $productId . '/single';

        return $this->doApiRequest($route, 'GET', [
            'type' => $type,
        ]);
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

    /**
     * Gets a modifier.
     *
     * @param int $modifierId
     * @return array
     */
    public function getModifier($modifierId)
    {
        $route = 'products/modifier/' . $modifierId;
        return $this->doApiRequest($route);
    }

    /**
     * Gets all of the modifiers for a product.
     *
     * @param int $productId
     * @return array
     */
    public function getProductModifiers($productId)
    {
        $route = 'products/modifiers/' . $productId;
        return $this->doApiRequest($route);
    }

    /**
     * Creates a new modifier for a product.
     *
     * @param int $productId
     * @param array $modifierData
     * @return array
     */
    public function newModifier($productId, $modifierData)
    {
        $route = 'products/' . $productId . '/modifier/new';
        return $this->doApiRequest($route, 'POST', $modifierData);
    }

    /**
     * Updates an existing modifier.
     *
     * @param int $modifierId
     * @param array $modifierData
     * @return array
     */
    public function updateModifier($modifierId, $modifierData)
    {
        $route = 'products/' . $modifierId . '/modifier/update';
        return $this->doApiRequest($route, 'POST', $modifierData);
    }

    /**
     * Deletes a modifier.
     *
     * @param int $modifierId
     * @return array
     */
    public function deleteModifier($modifierId)
    {
        $route = 'products/' . $modifierId . '/modifier/delete';
        return $this->doApiRequest($route, 'POST');
    }
}