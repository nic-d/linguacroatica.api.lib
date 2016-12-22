<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 14/03/2016
 * Time: 20:47
 */

namespace Hrvatski\Api\Model;

/**
 * Class Queue
 * @package Hrvatski\Api\Model
 */
class Queue extends Api
{
    /**
     * Queue constructor.
     * @param string $endpoint
     */
    public function __construct(string $endpoint)
    {
        parent::__construct($endpoint);
    }

    /**
     * Adds email data to the email queue.
     *
     * @param array $data
     * @return array
     */
    public function addToEmailQueue(array $data)
    {
        return $this->post('queue/email', $data);
    }
}