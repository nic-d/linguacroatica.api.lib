<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 12/10/2016
 * Time: 23:56
 */

namespace Hrvatski\Api\Model;

/**
 * Class Cache
 * @package Hrvatski\Api\Model
 */
class Cache extends Api
{
    /**
     * Cache constructor.
     * @param string $endpoint
     */
    public function __construct(string $endpoint)
    {
        parent::__construct($endpoint);
    }

    /**
     * Gets an item from the cache.
     *
     * @param string $key
     * @return array
     */
    public function getCacheItem(string $key)
    {
        return $this->get('cache/' . $key);
    }

    /**
     * Creates a new cache item.
     *
     * @param array $data
     * @return array
     */
    public function newCacheItem(array $data)
    {
        return $this->post('cache', $data);
    }

    /**
     * Deletes a cache item.
     *
     * @param string $key
     * @return array
     */
    public function deleteCacheItem(string $key)
    {
        return $this->delete('cache/' . $key);
    }
}