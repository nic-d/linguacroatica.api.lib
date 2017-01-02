<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 09/01/2016
 * Time: 20:32
 */

namespace Hrvatski\Api\Model;

/**
 * Class Billing
 * @package Hrvatski\Api\Model
 */
class Billing extends Api
{
    /**
     * Billing constructor.
     * @param string $endpoint
     */
    public function __construct(string $endpoint)
    {
        parent::__construct($endpoint);
    }

    /**
     * Gets a single (specific) transaction.
     *
     * @param string|int $transactionId
     * @return array
     */
    public function getTransaction($transactionId): array
    {
        if (is_string($transactionId)) {
            return $this->get('billing/transaction/' . $transactionId, [
                'type' => 'hash',
            ]);
        }

        return $this->get('billing/transaction/' . $transactionId);
    }

    /**
     * Creates a new payment.
     *
     * @param array $data
     * @return array
     */
    public function newTransaction(array $data): array
    {
        return $this->post('billing/payment', $data);
    }

    /**
     * Gets all of the restaurants cards.
     *
     * @param int $restaurantId
     * @return array
     */
    public function getCards(int $restaurantId): array
    {
        return $this->get('billing/cards/' . $restaurantId);
    }

    /**
     * Gets a card by its HASH or ID.
     *
     * @param string|int $cardId
     * @return array
     */
    public function getCard($cardId): array
    {
        if (is_string($cardId)) {
            return $this->get('billing/card/' . $cardId, [
                'type' => 'hash',
            ]);
        }

        return $this->get('billing/card/' . $cardId);
    }

    /**
     * Creates a new card.
     *
     * @param array $data
     * @return array
     */
    public function newCard(array $data): array
    {
        return $this->post('billing/card', $data);
    }

    public function updateCard(int $cardId, array $data): array
    {
    }

    /**
     * Deletes a card.
     *
     * @param int $restaurantId
     * @return array
     */
    public function deleteCard(int $restaurantId): array
    {
        return $this->delete('billing/card/' . $restaurantId);
    }

    /**
     * Gets the restaurants billing data.
     *
     * @param int $restaurantId
     * @return array
     */
    public function getCredit(int $restaurantId): array
    {
        return $this->get('billing/credit/' . $restaurantId);
    }

    /**
     * Gets the restaurant's plan data.
     *
     * @param int $restaurantId
     * @return array
     */
    public function getPlan(int $restaurantId): array
    {
        return $this->get('billing/plan/' . $restaurantId);
    }

    /**
     * Gets all of Hrvatski's plans.
     *
     * @return array
     */
    public function getPlans(): array
    {
        return $this->get('billing/plans');
    }

    /**
     * Updates the restaurant's plan.
     *
     * @param array $data
     * @return array
     */
    public function updatePlan(array $data): array
    {
        return $this->post('billing/plan', $data);
    }
}