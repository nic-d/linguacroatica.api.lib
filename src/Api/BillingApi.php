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
 * Class BillingApi
 * @package Nybbl\Api
 */
class BillingApi extends Api
{
    /**
     * BillingApi constructor.
     * @param string $endpoint
     * @param string $accessToken
     */
    public function __construct($endpoint, $accessToken)
    {
        parent::__construct($endpoint, $accessToken);
    }

    /**
     * Gets overview of billing data
     *
     * @param int $restaurantId
     * @return array
     */
    public function overview($restaurantId)
    {
        $route = 'billing/' . $restaurantId;
        return $this->doApiRequest($route);
    }

    /**
     * Gets all of the payments made by the
     * restaurant
     *
     * @param int $restaurantId
     * @return array
     */
    public function payments($restaurantId)
    {
        $route = 'billing/' . $restaurantId . '/payments';
        return $this->doApiRequest($route);
    }

    /**
     * Gets a payment by transaction ID
     *
     * @param string $transactionId
     * @return array
     */
    public function paymentById($transactionId)
    {
        $route = 'billing/payment/' . $transactionId;
        return $this->doApiRequest($route);
    }

    /**
     * Updates payment data
     *
     * @param string $transactionId
     * @param array $paymentData
     * @return array
     */
    public function updatePayment($transactionId, $paymentData)
    {
        $route = 'billing/' . $transactionId . '/payment/update';
        return $this->doApiRequest($route, 'POST', $paymentData);
    }

    /**
     * @param int $transactionId
     * @return array
     */
    public function deletePayment($transactionId)
    {
        $route = 'billing/payment/' . $transactionId . '/delete';
        return $this->doApiRequest($route, 'POST');
    }

    /**
     * Creates a new payment
     *
     * @param int $restaurantId
     * @param array $paymentData
     * @return array
     */
    public function newPayment($restaurantId, $paymentData)
    {
        $route = 'billing/' . $restaurantId . '/payment/new';
        return $this->doApiRequest($route, 'POST', $paymentData);
    }

    /**
     * Logs a payment error
     *
     * @param int $restaurantId
     * @param array $paymentData
     * @return array
     */
    public function logPaymentError($restaurantId, $paymentData)
    {
        $route = 'billing/' . $restaurantId . '/log/payment/error';
        return $this->doApiRequest($route, 'POST', $paymentData);
    }

    /**
     * Gets the restaurant's credits amount
     *
     * @param int $restaurantId
     * @return array
     */
    public function getCredit($restaurantId)
    {
        $route = 'billing/' . $restaurantId . '/credits';
        return $this->doApiRequest($route);
    }

    /**
     * Creates a new Credits record in the DB
     *
     * @param int $restaurantId
     * @param array $creditData
     * @return array
     */
    public function newCredit($restaurantId, $creditData)
    {
        $route = 'billing/' . $restaurantId . '/credits/new';
        return $this->doApiRequest($route, 'POST', $creditData);
    }

    /**
     * Updates the restaurant's credit data
     *
     * @param int $restaurantId
     * @param array $creditData
     * @return array
     */
    public function updateCredit($restaurantId, $creditData)
    {
        $route = 'billing/' . $restaurantId . '/credits/update';
        return $this->doApiRequest($route, 'POST', $creditData);
    }

    /**
     * Gets a Credit/Debit card by it's ID
     *
     * @param int $cardId
     * @return array
     */
    public function getCard($cardId)
    {
        $route = 'billing/card/' . $cardId;
        return $this->doApiRequest($route);
    }

    /**
     * Creates a new card
     *
     * @param array $cardData
     * @return array
     */
    public function newCard($cardData)
    {
        $route = 'billing/card/new';
        return $this->doApiRequest($route, 'POST', $cardData);
    }

    /**
     * Deletes the restaurant's card
     *
     * @param int $cardId
     * @param array $postData
     * @return array
     */
    public function deleteCard($cardId, $postData)
    {
        $route = 'billing/card/' . $cardId . '/delete';
        return $this->doApiRequest($route, 'POST', $postData);
    }

    /**
     * Gets all of our plans
     *
     * @return array
     */
    public function getAllPlans()
    {
        return $this->doApiRequest('billing/plans');
    }

    /**
     * Gets a plan by it's ID
     *
     * @param int $planId
     * @return array
     */
    public function getPlanId($planId)
    {
        $route = '/billing/plan/' . $planId;
        return $this->doApiRequest($route);
    }

    /**
     * Gets the plan that the restaurant is currently subscribed to
     *
     * @param int $restaurantId
     * @return array
     */
    public function getRestaurantPlan($restaurantId)
    {
        $route = 'billing/' . $restaurantId . '/plan';
        return $this->doApiRequest($route);
    }

    /**
     * Subscribes the restaurant to the
     * specified plan
     *
     * @param int $restaurantId
     * @param int $planId
     * @return array
     */
    public function subscribeToPlan($restaurantId, $planId)
    {
        $route = 'billing/' . $restaurantId . '/plan/subscribe';
        return $this->doApiRequest(
            $route,
            'POST',
            [
                'plan_id' => $planId,
            ]
        );
    }

    /**
     * Unsubscribes the restaurant from a plan
     *
     * @param int $restaurantId
     * @return array
     */
    public function unsubscribeFromPlan($restaurantId)
    {
        $route = 'billing/' . $restaurantId . '/plan/unsubscribe';
        return $this->doApiRequest($route, 'POST');
    }
}