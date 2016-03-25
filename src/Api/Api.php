<?php

namespace Nybbl\Api;

use \Curl\Curl;

/**
 * Class Api
 * @package Nybbl\Api
 */
class Api
{
	protected $endpoint;
	protected $accessToken;
	protected $curl;

    /**
     * Api constructor.
     * @param string $endpoint
     * @param string $accessToken
     */
    public function __construct($endpoint, $accessToken)
	{
        $this->setEndpoint($endpoint);
        $this->setAccessToken($accessToken);
        $this->setCurl(new Curl());
	}

    /**
     * Performs a CURL request to the Nybbl API
     *
     * @param string $url
     * @param string $method
     * @param array $data
     * @return array
     */
    public function doApiRequest($url, $method = 'GET', $data = [])
    {
        // Check the method type
        if ($method == 'POST') {
            // If there's data to post, then append
            if (!empty($data)) {
                $this->getCurl()->post($this->getEndpoint().$url.'?token='.$this->getAccessToken(), $data);
            } else {
                $this->getCurl()->post($this->getEndpoint().$url.'?token='.$this->getAccessToken());
            }
        } else {
            // Append data to url
            if (!empty($data)) {
                $query = http_build_query($data);
                $this->getCurl()->get($this->getEndpoint().$url.'?token='.$this->getAccessToken().'&'.$query);
            } else {
                $this->getCurl()->get($this->getEndpoint().$url.'?token='.$this->getAccessToken());
            }
        }

        return json_decode(json_encode($this->getCurl()->response), true);
    }

    # --------------------------------------------------------------------
    # GETTERS AND SETTERS
    # --------------------------------------------------------------------

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @return Curl
     */
    public function getCurl()
    {
        return $this->curl;
    }

    /**
     * @param Curl $curl
     */
    public function setCurl($curl)
    {
        $this->curl = $curl;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }
}