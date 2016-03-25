<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 14/03/2016
 * Time: 20:47
 */

namespace Nybbl\Api;

use Nybbl\Api\Api;

/**
 * Class QueueApi
 * @package Nybbl\Api
 */
class QueueApi extends Api
{
    /**
     * QueueApi constructor.
     * @param string $endpoint
     * @param string $accessToken
     */
    public function __construct($endpoint, $accessToken)
    {
        parent::__construct($endpoint, $accessToken);
    }

    /**
     * Adds data to the email queue
     *
     * @param array $data
     * @return array
     */
    public function createNewEmailQueue($data)
    {
        $route = '/queue/email';
        return $this->doApiRequest($route, 'POST', $data);
    }
}