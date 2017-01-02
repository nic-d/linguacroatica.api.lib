<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 02/01/2017
 * Time: 06:42
 */

namespace Hrvatski\Api\Model;

/**
 * Class Backend
 * @package Hrvatski\Api\Model
 */
class Backend extends Api
{
    /**
     * Backend constructor.
     * @param string $endpoint
     */
    public function __construct(string $endpoint)
    {
        parent::__construct($endpoint);
    }

    /**
     * Gets the backend user data.
     *
     * @param $userId
     * @return array
     */
    public function getBackendUser($userId)
    {
        if (is_string($userId)) {
            return $this->get('backend/user/' . $userId, [
                'type' => 'username',
            ]);
        }

        return $this->get('backend/user/' . $userId);
    }

    /**
     * Sends request to check if the user can login to the backend.
     *
     * @param string $username
     * @param string $password
     * @return array
     */
    public function backendLogin(string $username, string $password)
    {
        // Send post request
        return $this->post('backend/login', [
            'username' => $username,
            'password' => $password,
        ]);
    }
}