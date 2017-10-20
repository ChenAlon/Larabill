<?php

namespace Bwebi\Larabill\Contracts;

interface CreditCardActions
{
    /**
     * Store the credit card details.
     *
     * @param array $owner
     * @param int   $number
     * @param int   $month
     * @param int   $year
     * @param int   $cvv
     * @param int   $identity
     *
     * @return mixed
     */
    public function storeCreditCard(array $owner, $number, $month, $year, $cvv = null, $identity = null);

    /**
     * Charge the credit card.
     *
     * @param array $owner
     * @param float $amount
     * @param int   $payments
     *
     * @return mixed
     */
    public function chargeCreditCard(array $owner, $amount, $payments = 1);

    /**
     * Refund the credit card.
     *
     * @param array $owner
     * @param float $amount
     * @param int   $payments
     *
     * @return mixed
     */
    public function refundCreditCard(array $owner, $amount, $payments = 1);

    /**
     * Get the credit card token.
     *
     * @param int $number
     * @param int $month
     * @param int $year
     * @param int $cvv
     * @param int $identity
     *
     * @return mixed
     */
    public function getCreditCardToken($number, $month, $year, $cvv = null, $identity = null);
}
