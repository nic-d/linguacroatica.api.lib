<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 09/01/2016
 * Time: 20:32
 */

namespace Hrvatski\Api\Model;

/**
 * Class Category
 * @package Hrvatski\Api\Model
 */
class Category extends Api
{
    /**
     * Category constructor.
     * @param string $endpoint
     */
    public function __construct(string $endpoint)
    {
        parent::__construct($endpoint);
    }

    /**
     * Gets all categories.
     *
     * @return array
     */
    public function getCategories()
    {
        return $this->get('categories');
    }

    /**
     * Gets a single (specific) category.
     *
     * @param int $categoryId
     * @return array
     */
    public function getCategory(int $categoryId)
    {
        return $this->get('category/' . $categoryId);
    }

    /**
     * Creates a new category.
     *
     * @param array $data
     * @return array
     */
    public function newCategory(array $data)
    {
        return $this->post('category', $data);
    }

    /**
     * Updates a category.
     *
     * @param int $categoryId
     * @param array $data
     * @return array
     */
    public function updateCategory(int $categoryId, array $data)
    {
        return $this->put('category/' . $categoryId, $data);
    }

    /**
     * Deletes a category.
     *
     * @param int $categoryId
     * @return array
     */
    public function deleteCategory(int $categoryId)
    {
        return $this->delete('category/' . $categoryId);
    }
}