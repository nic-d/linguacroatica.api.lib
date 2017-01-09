<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 09/10/2016
 * Time: 00:43
 */

namespace Hrvatski\Api\Model;

/**
 * Class Payment
 * @package Api\Model
 */
class Payment extends Api
{
    const PAYMENT_TYPE_TRANSACTION_ID = 'transactionid';
    const PAYMENT_TYPE_ID = 'id';

    /**
     * Payment constructor.
     * @param string $endpoint
     */
    public function __construct(string $endpoint)
    {
        parent::__construct($endpoint);
    }

    /**
     * Gets the user's payments.
     *
     * @param int $userId
     * @return array
     */
    public function getUserPayments(int $userId)
    {
        return $this->get('payment/' . $userId . '/user');
    }

    /**
     * Gets a payment by its ID or its transactionId.
     *
     * @param $transactionId
     * @param string $type
     * @return array
     */
    public function getPayment($transactionId, string $type = self::PAYMENT_TYPE_ID)
    {
        switch ($type) {
            case self::PAYMENT_TYPE_ID:
                return $this->get('payment/' . $transactionId);
                break;

            case self::PAYMENT_TYPE_TRANSACTION_ID:
                return $this->get('payment/' . $transactionId, [
                    'type' => self::PAYMENT_TYPE_TRANSACTION_ID,
                ]);
                break;

            default:
                return $this->get('payment/' . $transactionId);
        }
    }

    /**
     * Creates a new payment.
     *
     * @param array $data
     * @return array
     */
    public function newPayment(array $data)
    {
        return $this->post('payment', $data);
    }

    /**
     * Refunds an existing payment.
     *
     * @param int $paymentId
     * @return array
     */
    public function refundPayment(int $paymentId)
    {
        return $this->post('payment/' . $paymentId);
    }

    /**
     * Deletes a payment.
     *
     * @param int $paymentId
     * @return array
     */
    public function deletePayment(int $paymentId)
    {
        return $this->delete('payment/' . $paymentId);
    }
}