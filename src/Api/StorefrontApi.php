<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 05/02/2016
 * Time: 22:15
 */

namespace Nybbl\Api;

use Nybbl\Api\Api;

/**
 * Class StorefrontApi
 * @package Nybbl\Api
 */
class StorefrontApi extends Api
{
    /**
     * StorefrontApi constructor.
     * @param string $endpoint
     * @param string $accessToken
     */
    public function __construct($endpoint, $accessToken)
    {
        parent::__construct($endpoint, $accessToken);
    }

    /**
     * Gets all of the restaurant's themes
     *
     * @param int $restaurantId
     * @return array
     */
    public function getThemes($restaurantId)
    {
        $route = '/storefront/theme/' . $restaurantId . '/all';
        return $this->doApiRequest($route);
    }

    /**
     * Gets a theme
     *
     * @param int $themeId
     * @return array
     */
    public function getTheme($themeId)
    {
        $route = '/storefront/theme/' . $themeId;
        return $this->doApiRequest($route);
    }

    /**
     * Creates a new theme
     *
     * @param int $restaurantId
     * @param array $postData
     * @return array
     */
    public function createNewTheme($restaurantId, $postData)
    {
        $route = '/storefront/theme/' . $restaurantId . '/new';
        return $this->doApiRequest($route, 'POST', $postData);
    }

    /**
     * Updates theme data
     *
     * @param int $themeId
     * @param array $postData
     * @return array
     */
    public function updateTheme($themeId, $postData)
    {
        $route = '/storefront/theme/' . $themeId . '/update';
        return $this->doApiRequest($route, 'POST', $postData);
    }

    /**
     * Deletes a theme
     *
     * @param int $themeId
     * @param array $postData
     * @return array
     */
    public function deleteTheme($themeId, $postData)
    {
        $route = '/storefront/theme/' . $themeId . '/delete';
        return $this->doApiRequest($route, 'POST', $postData);
    }

    /**
     * Gets a file
     *
     * @param int $fileId
     * @return array
     */
    public function getThemeFile($fileId)
    {
        $route = '/storefront/themefile/' . $fileId;
        return $this->doApiRequest($route);
    }

    /**
     * Creates a new theme file
     *
     * @param int $themeId
     * @param array $postData
     * @return array
     */
    public function createNewThemeFile($themeId, $postData)
    {
        $route = '/storefront/themefile/' . $themeId . '/new';
        return $this->doApiRequest($route, 'POST', $postData);
    }

    /**
     * Update a theme file
     *
     * @param int $fileId
     * @param array $postData
     * @return array
     */
    public function updateThemeFile($fileId, $postData)
    {
        $route = '/storefront/themefile/' . $fileId . '/update';
        return $this->doApiRequest($route, 'POST', $postData);
    }

    /**
     * Deletes a theme file
     *
     * @param int $fileId
     * @return array
     */
    public function deleteThemeFile($fileId)
    {
        $route = '/storefront/themefile/' . $fileId . '/delete';
        return $this->doApiRequest($route, 'POST');
    }
}