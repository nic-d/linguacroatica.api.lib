<?php

namespace Hrvatski\Api\Model;

use \Curl\Curl;

/**
 * Class Api
 * @package Hrvatski\Api\Model
 */
class Api
{
    /** @var Curl $curl */
    protected $curl;

    /** @var string $endpoint */
	protected $endpoint;

    // CURL RESPONSE VARS
    protected $error;
    protected $status;
    protected $raw;
    protected $headers;
    protected $data;

    const VERSION = '1.0';

    /**
     * Api constructor.
     * @param string $endpoint
     */
    public function __construct(string $endpoint)
	{
        $this->setEndpoint($endpoint);

        $this->setCurl(new Curl());
        $this->getCurl()->setUserAgent('Hrvatski API Library Version: ' . self::VERSION);
	}

    /**
     * Sends a GET request.
     *
     * Used for read-only.
     *
     * @param string $url
     * @param array $data
     * @return array
     */
    protected function get($url, $data = [])
    {
        return $this->doApiRequest($url, 'GET', $data);
    }

    /**
     * Sends a POST request.
     *
     * Used for creating a new resource.
     *
     * @param string $url
     * @param array $data
     * @return array
     */
    protected function post($url, $data = [])
    {
        return $this->doApiRequest($url, 'POST', $data);
    }

    /**
     * Sends a PUT request.
     *
     * Used for updating an existing resource.
     *
     * @param string $url
     * @param array $data
     * @return array
     */
    protected function put($url, $data = [])
    {
        return $this->doApiRequest($url, 'PUT', $data);
    }

    /**
     * Sends a PATCH request.
     *
     * @param $url
     * @param array $data
     * @return array
     */
    protected function patch($url, $data = [])
    {
        return $this->doApiRequest($url, 'PATCH', $data);
    }

    /**
     * Sends a DELETE request.
     *
     * Used for deleting a resource.
     *
     * @param string $url
     * @param array $data
     * @return array
     */
    protected function delete($url, $data = [])
    {
        return $this->doApiRequest($url, 'DELETE', $data);
    }

    /**
     * Performs a CURL request to the Hrvatski API.
     *
     * @param string $url
     * @param string $method
     * @param array $data
     * @return array
     */
    private function doApiRequest($url, $method = 'GET', $data = [])
    {
        // Build the complete URL to include the API token
        $completeUrl = $this->buildURL($url);

        switch (strtolower($method)) {
            case 'get':
                if (!empty($data)) {
                    $this->getCurl()->get($completeUrl . '?' . http_build_query($data));
                } else {
                    $this->getCurl()->get($completeUrl);
                }
                break;

            case 'post':
                if (!empty($data)) {
                    $this->getCurl()->post($completeUrl, $data);
                } else {
                    $this->getCurl()->post($completeUrl);
                }
                break;

            case 'put':
                if (!empty($data)) {
                    $this->getCurl()->put($completeUrl, $data);
                } else {
                    $this->getCurl()->put($completeUrl);
                }
                break;

            case 'patch':
                if (!empty($data)) {
                    $this->getCurl()->patch($completeUrl, $data);
                } else {
                    $this->getCurl()->patch($completeUrl);
                }
                break;

            case 'delete':
                if (!empty($data)) {
                    $this->getCurl()->delete($completeUrl, [], $data);
                } else {
                    $this->getCurl()->delete($completeUrl);
                }
                break;
        }

        // Encode and decode the data so that we get an assoc array
        return json_decode(json_encode($this->getCurl()->response), true);
    }

    /**
     * Builds the URL with the endpoint and API Url.
     *
     * @param string $url
     * @return string
     */
    protected function buildURL($url)
    {
        return $this->getEndpoint() . $url;
    }

    # --------------------------------------------------------------------
    # GETTERS AND SETTERS
    # --------------------------------------------------------------------

    /**
     * @return Curl
     */
    protected function getCurl(): Curl
    {
        return $this->curl;
    }

    /**
     * @param Curl $curl
     */
    protected function setCurl(Curl $curl)
    {
        $this->curl = $curl;
    }

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

    /**
     * @return mixed
     */
    protected function getError()
    {
        return $this->error;
    }

    /**
     * @param mixed $error
     */
    protected function setError($error)
    {
        $this->error = $error;
    }

    /**
     * @return mixed
     */
    protected function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    protected function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    protected function getRaw()
    {
        return $this->raw;
    }

    /**
     * @param mixed $raw
     */
    protected function setRaw($raw)
    {
        $this->raw = $raw;
    }

    /**
     * @return mixed
     */
    protected function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param mixed $headers
     */
    protected function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    /**
     * @return mixed
     */
    protected function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    protected function setData($data)
    {
        $this->data = $data;
    }
}