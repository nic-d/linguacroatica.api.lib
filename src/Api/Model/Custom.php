<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 05/01/2017
 * Time: 01:16
 */

namespace Hrvatski\Api\Model;

/**
 * Class Custom
 * @package Hrvatski\Api\Model
 */
class Custom extends Api
{
    /**
     * Custom constructor.
     * @param string $endpoint
     */
    public function __construct(string $endpoint)
    {
        parent::__construct($endpoint);
    }

    /**
     * Allows you to make a custom request.
     * This is useful when the API lib currently
     * doesn't support a route.
     *
     * @param string $url
     * @param string $type
     * @param array $data
     * @return array
     */
    public function request(string $url, string $type = 'GET', array $data = [])
    {
        switch (strtolower($type)) {
            case 'get':
                return $this->get($url, $data);
                break;

            case 'post':
                return $this->post($url, $data);
                break;

            case 'put':
                return $this->put($url, $data);
                break;

            case 'patch':
                return $this->patch($url, $data);
                break;

            case 'delete':
                return $this->delete($url, $data);
                break;
        }
    }
}