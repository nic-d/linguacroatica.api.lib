<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 09/01/2016
 * Time: 20:32
 */

namespace Hrvatski\Api\Model;

/**
 * Class User
 * @package Hrvatski\Api\Model
 */
class User extends Api
{
    const USER_TYPE_USERNAME = 'username';
    const USER_TYPE_EMAIL = 'email';
    const USER_TYPE_ID = 'id';

    /**
     * User constructor.
     * @param string $endpoint
     */
    public function __construct(string $endpoint)
    {
        parent::__construct($endpoint);
    }

    /**
     * Gets all users.
     *
     * @return array
     */
    public function getUsers()
    {
        return $this->get('users');
    }

    /**
     * Gets a user by ID or username.
     *
     * @param string|int $userId
     * @param string $type
     * @return array
     */
    public function getUser($userId, string $type = self::USER_TYPE_ID)
    {
        switch ($type) {
            case self::USER_TYPE_ID:
                return $this->get('user/' . $userId);
                break;

            case self::USER_TYPE_USERNAME:
                return $this->get('user/' . $userId, [
                    'type' => self::USER_TYPE_USERNAME,
                ]);
                break;

            case self::USER_TYPE_EMAIL:
                return $this->get('user/' . $userId, [
                    'type' => self::USER_TYPE_EMAIL,
                ]);
                break;

            default:
                return $this->get('user/' . $userId);
        }
    }

    /**
     * Gets the user's activity.
     *
     * @param int $userId
     * @param int $page
     * @param bool $all
     * @return array
     */
    public function getActivity(int $userId, int $page = 1, bool $all = false)
    {
        return $this->get('user/' . $userId . '/activity', [
            'page' => $page,
            'all' => $all,
        ]);
    }

    /**
     * Creates a new user account.
     *
     * @param array $data
     * @return array
     */
    public function newUser(array $data)
    {
        return $this->post('user', $data);
    }

    /**
     * Updates a user.
     *
     * @param int $userId
     * @param array $data
     * @param string|null $filename
     * @return array
     */
    public function updateUser(int $userId, array $data, $filename = null)
    {
        if (!is_null($filename)) {
            // Append the file onto a new array
            $postData['profile_image'] = '@' . $filename;
            $postData = array_merge($postData, $data);

            // We have to use POST to upload
            return $this->post('user/' . $userId, $postData);
        }

        return $this->put('user/' . $userId, $data);
    }

    /**
     * Deletes a user.
     *
     * @param int $userId
     * @return array
     */
    public function deleteUser(int $userId)
    {
        return $this->delete('user/' . $userId);
    }

    /**
     * Deletes an invite.
     *
     * @param string $inviteId
     * @return array
     */
    public function deleteInvite(string $inviteId)
    {
        return $this->delete('user/invite/' . $inviteId);
    }

    /**
     * Logs user activity.
     *
     * @param int $userId
     * @param array $data
     * @return array
     */
    public function log(int $userId, array $data)
    {
        return $this->post('user/' . $userId . '/log', $data);
    }

    /**
     * Sends request to check if the user can login.
     *
     * @param string $username
     * @param string $password
     * @param string $ipAddress
     * @return array
     */
    public function login(string $username, string $password, string $ipAddress)
    {
        // Send post request
        return $this->post('user/login', [
            'username'   => $username,
            'password'   => $password,
            'ip_address' => $ipAddress,
        ]);
    }
}