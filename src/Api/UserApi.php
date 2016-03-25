<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 09/01/2016
 * Time: 20:32
 */

namespace Nybbl\Api;

use Nybbl\Api\Api;

/**
 * Class UserApi
 * @package Nybbl\Api
 */
class UserApi extends Api
{
    /**
     * UserApi constructor.
     * @param string $endpoint
     * @param string $accessToken
     */
    public function __construct($endpoint, $accessToken)
    {
        parent::__construct($endpoint, $accessToken);
    }

    /**
     * Logs the user in if the password/username/subdomain is correct
     *
     * @param string $username
     * @param string $password
     * @param string $subdomain
     * @return array
     */
    public function login($username, $password, $subdomain)
    {
        return $this->doApiRequest('login', 'POST', [
            'username' => $username,
            'password' => $password,
            'subdomain' => $subdomain,
        ]);
    }

    /**
     * Creates a new user account with a restaurant account
     * OR only creates a new user account
     *
     * @param string $username
     * @param string $password
     * @param string $email
     * @param null|string $restaurantName
     * @param null|string $token
     * @return array
     */
    public function register($username, $password, $email, $restaurantName = null, $token = null)
    {
        return $this->doApiRequest('register', 'POST', array(
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'restaurant_name' => $restaurantName,
            'token' => $token,
        ));
    }

    /**
     * Sets a forgot token so that the user
     * can reset their password
     *
     * @param string $email
     * @return array
     */
    public function forgot($email)
    {
        return $this->doApiRequest('forgot', 'POST', [
            'email' => $email,
        ]);
    }

    /**
     * Sets a forgot token so that the user
     * can reset their password
     *
     * @param string $token
     * @param string $password
     * @return array
     */
    public function reset($token, $password)
    {
        return $this->doApiRequest('reset', 'POST', [
            'token' => $token,
            'password' => $password,
        ]);
    }

    /**
     * Gets a forgot token
     *
     * @param string $token
     * @return array
     */
    public function getForgotToken($token)
    {
        $route = 'forgot/' . $token;
        return $this->doApiRequest($route);
    }

    /**
     * Invites a user so that they can set up their account
     *
     * @param int $restaurantId
     * @param string $email
     * @return array
     */
    public function invite($restaurantId, $email)
    {
        return $this->doApiRequest('invite', 'POST', array(
            'restaurant_id' => $restaurantId,
            'email' => $email,
        ));
    }

    /**
     * Gets an invite using the token
     *
     * @param string $token
     * @return array
     */
    public function getInvite($token)
    {
        return $this->doApiRequest('invite', 'GET', [
            'invitetoken' => $token,
        ]);
    }

    /**
     * Deletes an invite using the token
     *
     * @param string $token
     * @return array
     */
    public function deleteInvite($token)
    {
        $route = 'invite/' . $token . '/delete';
        return $this->doApiRequest($route, 'POST');
    }

    /**
     * Get's the user
     *
     * @param int $userId
     * @return array
     */
    public function getUser($userId)
    {
        $route = 'user/' . $userId;
        return $this->doApiRequest($route);
    }

    /**
     * Updates the user's data
     *
     * @param int $userId
     * @param array $userData
     * @return array
     */
    public function updateUser($userId, $userData)
    {
        $route = 'user/' . $userId . '/update';
        return $this->doApiRequest($route, 'POST', $userData);
    }

    /**
     * Deletes a user
     *
     * @param int $userId
     * @return array
     */
    public function deleteUser($userId)
    {
        $route = 'user/' . $userId . '/delete';
        return $this->doApiRequest($route, 'POST');
    }

    /**
     * Get's the user's activity
     *
     * @param int $userId
     * @param int $page
     * @return array
     */
    public function getUserActivity($userId, $page)
    {
        $route = 'user/' . $userId . '/activity';

        if (!is_null($page)) {
            return $this->doApiRequest($route, 'GET',
                ['page' => $page]
            );
        }

        return $this->doApiRequest($route);
    }

    /**
     * Logs a new record for the user activity
     *
     * @param int $userId
     * @param int $restaurantId
     * @param string $activity
     * @return array
     */
    public function logUserActivity($userId, $restaurantId, $activity)
    {
        $route = 'user/' . $userId . '/activity/track';

        return $this->doApiRequest($route, 'POST', [
            'restaurant_id' => $restaurantId,
            'content' => $activity,
        ]);
    }

    /**
     * Gets the user's cookie
     *
     * @param int $userId
     * @param bool|false $useToken
     * @return array
     */
    public function getUserCookie($userId, $useToken = false)
    {
        $route = 'user/' . $userId . '/cookie';
        return $this->doApiRequest($route, 'GET', ['useToken' => $useToken]);
    }

    /**
     * Sets a new cookie for the user
     *
     * @param int $userId
     * @return array
     */
    public function setUserCookie($userId)
    {
        $route = 'user/' . $userId . '/cookie';
        return $this->doApiRequest($route, 'POST');
    }
}