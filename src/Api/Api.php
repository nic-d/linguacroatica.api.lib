<?php

namespace Nybbl\Api;

use \Curl\Curl;

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
		$this->endpoint = $endpoint;
		$this->accessToken = $accessToken;

		$this->curl = new Curl();
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
                $this->curl->post($this->endpoint.$url.'?token='.$this->accessToken, $data);
            } else {
                $this->curl->post($this->endpoint.$url.'?token='.$this->accessToken);
            }
        } else {
            // Append data to url
            if (!empty($data)) {
                $query = http_build_query($data);
                $this->curl->get($this->endpoint.$url.'?token='.$this->accessToken.'&'.$query);
            } else {
                $this->curl->get($this->endpoint.$url.'?token='.$this->accessToken);
            }
        }

        return json_decode(json_encode($this->curl->response), true);
    }

    #---------------------------------------------------------------
    #- GENERAL REQUESTS
    #---------------------------------------------------------------

    /**
     * Searches the DB for something matching the query
     *
     * @param string $query
     * @param int $restaurantId
     * @return array
     */
    public function getSearch($query, $restaurantId)
    {
        return $this->doApiRequest('search', 'GET', ['q' => $query, 'restaurantId' => $restaurantId]);
    }

    /**
     * Checks if a subdomain
     *
     * @param string $subdomain
     * @return array
     */
    public function checkSubdomainExists($subdomain)
    {
    	$subdomainRoute = 'subdomain/' . $subdomain;
    	return $this->doApiRequest($subdomainRoute);
    }

    /**
     * Gets a list of nybbl domains
     *
     * @return array
     */
    public function getDomainList()
    {
        return $this->doApiRequest('domains');
    }

    /**
     * Get a specific domain using TLD or ID
     *
     * @param int|string $id
     * @return array
     */
    public function getDomain($id)
    {
        return $this->doApiRequest('domain/'.$id);
    }

    #---------------------------------------------------------------
    #- ANALYTICS REQUESTS
    #---------------------------------------------------------------

    /**
     * Gets analytics data
     *
     * @param int $restaurantId
     * @return array
     */
    public function getAnalytics($restaurantId)
    {
        $route = 'analytics/' . $restaurantId;
        return $this->doApiRequest($route);
    }

    /**
     * Gets order analytics data
     *
     * @param int $restaurantId
     * @return array
     */
    public function getOrderAnalytics($restaurantId)
    {
        $route = 'analytics/orders/' . $restaurantId;
        return $this->doApiRequest($route);
    }

    #---------------------------------------------------------------
    #- RESTAURANT REQUESTS
    #---------------------------------------------------------------

    /**
     * Performs a GET request to get restaurant settings
     *
     * @param object Slim $slimApp
     * @param int $restaurantId
     * @return array
     */
    public function getRestaurantSettings($restaurantId)
    {
        $route = 'restaurant/' . $restaurantId . '/settings';
        return $this->doApiRequest($route);
    }

    public function updateRestaurantSettings($restaurantId, $updateData)
    {
        $route = 'restaurant/' . $restaurantId . '/update';
        return $this->doApiRequest($route, 'POST', $updateData);
    }

    public function updateRestaurantStorefrontSettings($restaurantId, $updateData)
    {
        $route = '/restaurant/' . $restaurantId . '/update/storefront';
        return $this->doApiRequest($route, 'POST', $updateData);
    }

    public function updateRestaurantPaymentSettings($restaurantId, $updateData)
    {
        $route = '/restaurant/' . $restaurantId . '/update/payment';
        return $this->doApiRequest($route, 'POST', $updateData);
    }

    public function updateRestaurantStripeCustomerId($restaurantId, $stripeCustomerId)
    {
        $route = 'restaurant/' . $restaurantId . '/update/stripe-customer';
        return $this->doApiRequest($route, 'POST', ['stripe_customer_id' => $stripeCustomerId]);
    }

    public function getRestaurantActivityRequest($restaurantId, $page = null)
    {
        $route = 'restaurant/' . $restaurantId . '/activity';

        if (!is_null($page)) {
            return $this->doApiRequest($route, 'GET', ['page' => $page]);
        }

        return $this->doApiRequest($route);
    }

    #---------------------------------------------------------------
    #- USER REQUESTS
    #---------------------------------------------------------------

    /**
     * Sends a login post request to the API
     *
     * @param string $username
     * @param string $password
     * @param string $subdomain
     * @return array
     */
    public function loginRequest($username, $password, $subdomain)
    {
        return $this->doApiRequest('login', 'POST', array(
            'username' => $username,
            'password' => $password,
            'subdomain' => $subdomain,
        ));
    }

    /**
     * Sends a register post request to the API
     *
     * @param string $username
     * @param string $password
     * @param string $restaurantName
     * @param string $token
     * @return array
     */
    public function registerRequest($username, $password, $email, $restaurantName = null, $token = null)
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
     * Sets a forgot token in the DB for the user
     * so that they can reset their password
     *
     * @param string $email
     * @return array
     */
    public function forgotRequest($email)
    {
        return $this->doApiRequest('forgot', 'POST', array(
            'email' => $email,
        ));
    }

    /**
     * Sets a forgot token in the DB for the user
     * so that they can reset their password
     *
     * @param string $token
     * @param string $password
     * @return array
     */
    public function resetRequest($token, $password)
    {
        return $this->doApiRequest('reset', 'POST', array(
            'token' => $token,
            'password' => $password,
        ));
    }

    /**
     * Checks if a forgot token exists
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
    public function inviteRequest($restaurantId, $email)
    {
        return $this->doApiRequest('invite', 'POST', array(
            'restaurant_id' => $restaurantId,
            'email' => $email,
        ));
    }

    /**
     * Gets invite using the invite token
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
        $route = 'invite/'. $token . '/delete';

        return $this->doApiRequest($route, 'POST');
    }

    /**
     * Deletes a user
     *
     * @param int $userId
     * @return array
     */
    public function deleteUserRequest($userId)
    {
        $route = 'user/' . $userId . '/delete';
        return $this->doApiRequest($route, 'POST');
    }

    /**
     * Updates a user
     *
     * @param int $userId
     * @param array $updateData
     * @return array
     */
    public function updateUserRequest($userId, $updateData)
    {
        $route = 'user/' . $userId . '/update';
        return $this->doApiRequest($route, 'POST', $updateData);
    }

    /**
     * Gets a user from the API using ID or username
     *
     * @param int|string $id
     * @return array
     */
    public function getUserRequest($id)
    {
        $route = 'user/' . $id;
        return $this->doApiRequest($route);
    }

    /**
     * Gets user's activity from API
     *
     * @param int $id
     * @return array
     */
    public function getUserActivityRequest($id, $page = null)
    {
        $route = 'user/' . $id . '/activity';

        if (!is_null($page)) {
            return $this->doApiRequest($route, 'GET', ['page' => $page]);
        }

        return $this->doApiRequest($route);
    }

    /**
     * @param int $userId
     * @param int $restaurantId
     * @param string $activity
     * @return array
     */
    public function trackUserActivity($userId, $restaurantId, $activity)
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
     * @param bool $useToken
     * @return array
     */
    public function getUserCookie($userId, $useToken = false)
    {
        $route = 'user/' . $userId . '/cookie';
        return $this->doApiRequest($route, 'GET', ['useToken' => $useToken]);
    }

    /**
     * Sets the user's cookie_key and cookie_status
     *
     * @param int $userId
     * @return array
     */
    public function setUserCookie($userId)
    {
        $route = 'user/' . $userId . '/cookie';
        return $this->doApiRequest($route, 'POST');
    }

    #---------------------------------------------------------------
    #- TEAM REQUESTS
    #---------------------------------------------------------------

    /**
     * Gets restaurant's team from API
     *
     * @param int|string $id
     * @return array
     */
    public function getTeamRequest($restaurantId)
    {
        $route = 'team/' . $restaurantId;
        return $this->doApiRequest($route);
    }

    #---------------------------------------------------------------
    #- BILLING REQUESTS
    #---------------------------------------------------------------

    /**
     * Sends a login post request to the API
     *
     * @param int $restaurantId
     * @return array
     */
    public function billingRequest($restaurantId)
    {
        $route = 'billing/' . $restaurantId;
        return $this->doApiRequest($route);
    }

    public function billingPaymentRequest($restaurantId)
    {
        $route = '/billing/'. $restaurantId .'/payments';
        return $this->doApiRequest($route);
    }

    public function billingPaymentById($transactionId)
    {
        $route = 'billing/payment/'.$transactionId;
        return $this->doApiRequest($route);
    }

    public function billingNewPayment($restaurantId, $postData)
    {
        $route = '/billing/' . $restaurantId . '/payment/new';
        return $this->doApiRequest($route, 'POST', $postData);
    }

    public function billingUpdateCredits($restaurantId, $postData)
    {
        $route = '/billing/' . $restaurantId . '/credits/update';
        return $this->doApiRequest($route, 'POST', $postData);
    }

    public function billingLogError(array $postData)
    {
        $route = 'billing/' . $postData['restaurant_id'] . '/log/payment/error';
        return $this->doApiRequest($route, 'POST', $postData);
    }

    /**
     * Creates a new card
     *
     * @param array $postData
     * @return array
     */
    public function newCardRequest(array $postData)
    {
        $route = 'billing/card/new';
        return $this->doApiRequest($route, 'POST', $postData);
    }

    /**
     * Gets a card by it's ID
     *
     * @param int $cardId
     * @return array
     */
    public function getCardRequest($cardId)
    {
        $route = 'billing/card/' . $cardId;
        return $this->doApiRequest($route);
    }

    /**
     * Deletes a card
     *
     * @param int $cardId
     * @return array
     */
    public function deleteCardRequest($cardId)
    {
        $route = '/billing/card/' . $cardId . '/delete';
        return $this->doApiRequest($route, 'POST');
    }

    public function getPlanById($planId)
    {
    }

    /**
     * Gets all plans
     *
     * @return array
     */
    public function getAllPlans()
    {
        return $this->doApiRequest('/billing/plans');
    }

    /**
     * Subscribes to a plan
     *
     * @param int $restaurantId
     * @param int $planId
     * @return array
     */
    public function subscribe($restaurantId, $planId)
    {
        $route = '/billing/' . $restaurantId . '/plan/subscribe';
        return $this->doApiRequest($route, 'POST', ['plan_id' => $planId]);
    }

    /**
     * Unsubscribes from a plan
     *
     * @param int $restaurantId
     * @return array
     */
    public function unsubscribe($restaurantId)
    {
        $route = '/billing/' . $restaurantId . '/plan/unsubscribe';
        return $this->doApiRequest($route, 'POST');
    }
}
