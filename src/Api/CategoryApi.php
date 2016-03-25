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
 * Class CategoryApi
 * @package Nybbl\Api
 */
class CategoryApi extends Api
{
    /**
     * CategoryApi constructor.
     * @param string $endpoint
     * @param string $accessToken
     */
    public function __construct($endpoint, $accessToken)
    {
        parent::__construct($endpoint, $accessToken);
    }

    /**
     * Gets a category by its ID / name
     *
     * @param int $categoryId
     * @param string $type
     * @return array
     */
    public function getCategory($categoryId, $type)
    {
        $route = 'category/' . $categoryId;
        return $this->doApiRequest($route, 'GET', ['type' => $type]);
    }

    /**
     * Gets all categories
     *
     * @param int $restaurantId
     * @return array
     */
    public function getCategories($restaurantId)
    {
        $route = 'category/' . $restaurantId . '/all';
        return $this->doApiRequest($route);
    }

    /**
     * Sends a post request to create a new category
     *
     * @param int $restaurantId
     * @param int $userId
     * @param string $categoryName
     * @return array
     */
    public function createNewCategory($restaurantId, $userId, $categoryName)
    {
        $route = 'category/' . $restaurantId . '/new';

        return $this->doApiRequest($route, 'POST', array(
            'created_by_user' => $userId,
            'category_name' => $categoryName,
        ));
    }

    /**
     * Deletes a category
     *
     * @param int $restaurantId
     * @param int $categoryId
     * @return array
     */
    public function deleteCategory($restaurantId, $categoryId)
    {
        $route = 'category/' . $categoryId . '/delete';

        return $this->doApiRequest($route, 'POST', array(
            'restaurant_id' => $restaurantId,
        ));
    }
}