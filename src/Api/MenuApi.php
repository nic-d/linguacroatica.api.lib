<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 17/04/2016
 * Time: 00:38
 */

namespace Nybbl\Api;

use Nybbl\Api\Api;

/**
 * Class MenuApi
 * @package Nybbl\Api
 */
class MenuApi extends Api
{
    /**
     * MenuApi constructor.
     * @param string $endpoint
     * @param string $accessToken
     */
    public function __construct($endpoint, $accessToken)
    {
        parent::__construct($endpoint, $accessToken);
    }

    /**
     * Gets all of the restaurant's menus.
     *
     * @param int $restaurantId
     * @return array
     */
    public function getMenus($restaurantId)
    {
        $route = 'menu/' . $restaurantId . '/all';
        return $this->doApiRequest($route);
    }

    /**
     * Gets a menu.
     *
     * @param int|string $menuId
     * @return array
     */
    public function getMenu($menuId)
    {
        $route = 'menu/' . $menuId;
        return $this->doApiRequest($route);
    }

    /**
     * Gets the restaurant's active menu.
     *
     * @param int $restaurantId
     * @return array
     */
    public function getActiveMenu($restaurantId)
    {
        $route = 'menu/' . $restaurantId . '/active';
        return $this->doApiRequest($route);
    }

    /**
     * Gets a menu's products.
     *
     * @param int $menuId
     * @return array
     */
    public function getMenuProducts($menuId)
    {
        $route = 'menu/' . $menuId . '/products';
        return $this->doApiRequest($route);
    }

    /**
     * Create a new menu.
     *
     * @param int $restaurantId
     * @param array $postData
     * @return array
     */
    public function newMenu($restaurantId, $postData)
    {
        $route = 'menu/' . $restaurantId . '/new';
        return $this->doApiRequest($route, 'POST', $postData);
    }

    /**
     * Update an existing menu.
     *
     * @param int $menuId
     * @param array $postData
     * @return array
     */
    public function updateMenu($menuId, $postData)
    {
        $route = '/menu/' . $menuId . '/update';
        return $this->doApiRequest($route, 'POST', $postData);
    }

    /**
     * Adds products to a menu.
     *
     * @param int $menuId
     * @param int $productId
     * @return array
     */
    public function addMenuProducts($menuId, $productId)
    {
        $route = 'menu/' . $menuId . '/products';
        return $this->doApiRequest($route, 'POST', [
            'product_id' => $productId,
        ]);
    }

    /**
     * Removes a product from a menu.
     *
     * @param int $menuId
     * @param int $productId
     * @return array
     */
    public function removeMenuProducts($menuId, $productId)
    {
        $route = 'menu/' . $menuId . '/products/remove';
        return $this->doApiRequest($route, 'POST', [
            'product_id' => $productId,
        ]);
    }

    /**
     * Deletes a menu.
     *
     * @param int $menuId
     * @return array
     */
    public function deleteMenu($menuId)
    {
        $route = 'menu/' . $menuId . '/delete';
        return $this->doApiRequest($route, 'POST');
    }
}