<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 27/06/2016
 * Time: 18:07
 */

namespace Hrvatski\Api;

use Hrvatski\Api\Model\Test;
use Hrvatski\Api\Model\User;
use Hrvatski\Api\Model\Lesson;
use Hrvatski\Api\Model\Module;
use Hrvatski\Api\Model\Payment;
use Hrvatski\Api\Model\General;
use Hrvatski\Api\Model\Backend;

/**
 * Class Client
 * @package Hrvatski\Api
 */
class Client
{
    /** @var string $endpoint */
    protected $endpoint;

    /**
     * Sets the Endpoint for the API classes
     * to send requests to.
     *
     * @param string $endpoint
     * @throws \Exception
     */
    public function authenticate(string $endpoint)
    {
        $this->setEndpoint($endpoint);
    }

    /**
     * Allows you to call any API class using $client->api('user').
     *
     * @param string $name
     * @return Module|General|Payment|User|Lesson|Backend|Test
     * @throws \Exception
     */
    public function api(string $name)
    {
        switch ($name) {
            case 'module':
                $apiClass = new Module($this->getEndpoint());
                break;

            case 'general':
                $apiClass = new General($this->getEndpoint());
                break;

            case 'user':
                $apiClass = new User($this->getEndpoint());
                break;

            case 'payment':
                $apiClass = new Payment($this->getEndpoint());
                break;

            case 'lesson':
                $apiClass = new Lesson($this->getEndpoint());
                break;

            case 'backend':
                $apiClass = new Backend($this->getEndpoint());
                break;

            case 'test':
                $apiClass = new Test($this->getEndpoint());
                break;

            default:
                throw new \Exception('API Class: ' . $name . ' doesn\'t exist.');
        }

        // Return the API class
        return $apiClass;
    }

    /**
     * Proxies $this->user() to $this->api('user').
     *
     * @param string $name
     * @param $args
     * @return Module|General|Payment|User|Lesson|Backend|Test
     * @throws \Exception
     */
    public function __call(string $name, $args)
    {
        try {
            return $this->api($name);
        } catch (\Exception $e) {
            throw new \Exception('API Class: ' . $name . ' doesn\'t exist.');
        }
    }

    # --------------------------------------------------------------------
    # GETTERS AND SETTERS
    # --------------------------------------------------------------------

    /**
     * @return string
     */
    protected function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     */
    protected function setEndpoint(string $endpoint)
    {
        $this->endpoint = $endpoint;
    }
}