<?php

namespace Bwebi\Larabill\Gateways;

use Bwebi\Larabill\Contracts\CreditCardActions;
use Bwebi\Larabill\Contracts\GatewayAuthenticate;
use Bwebi\Larabill\Exceptions\GatewayException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Validation\UnauthorizedException;

class IcountGateway extends AbstractGateway implements GatewayAuthenticate, CreditCardActions
{
    /**
     *  API company.
     *
     * @var string
     */
    protected $company;

    /**
     *  API Session Id.
     *
     * @var string
     */
    protected $session_id;


    public function __construct()
    {
        parent::__construct();

        $this->name     = 'icount';
        $this->username = config('larabill.gateways.'.$this->name.'.username');
        $this->company  = config('larabill.gateways.'.$this->name.'.company');
        $this->password = config('larabill.gateways.'.$this->name.'.password');
    }

    /**
     * Authenticate and sets the session id
     *
     * @return bool
     * @throws UnauthorizedException
     * @throws GatewayException
     */
    public function authenticate() : bool
    {
        $endpoint = $this->base_url . 'auth/login';
        $parameters = [
            'json' => [
                'cid' => $this->company,
                'user' => $this->username,
                'pass' => $this->password
            ]
        ];

        $response = json_decode($this->postRequest($endpoint, $parameters)->getBody()->getContents());

        if (!$response->status)
            throw new UnauthorizedException($response->error_description);

        $this->session_id = $response->sid;

        return true;
    }

    /**
     * Store the credit card details
     *
     * @param array $owner
     * @param int $number
     * @param int $month
     * @param int $year
     * @param int $cvv
     * @param int $identity
     * @return mixed
     * @throws GatewayException
     */
    public function storeCreditCard(array $owner, $number, $month, $year, $cvv = null, $identity = null)
    {
        $endpoint = $this->base_url . 'cc_storage/store';
        $parameters = [
            'json' => [
                'sid' => $this->session_id,
                'cid' => $this->company,
                'user' => $this->username,
                'pass' => $this->password,

                'vat_id' => $owner['vat_id'],
                'email' => $owner['email'],
                'client_name' => $owner['name'],

                'cc_number' => $number,
                'cc_cvv' => $cvv,
                'cc_validity' => $month.$year,
                'cc_holder_id' => $identity
            ]
        ];

        $response = json_decode($this->postRequest($endpoint, $parameters)->getBody()->getContents());

        if (!$response->status)
            throw new GatewayException($response->error_description);

        $this->session_id = $response->sid;

        return $this;
    }

    /**
     * Charge the credit card
     *
     * @param array $owner
     * @param float $amount
     * @param int $payments
     * @return mixed
     */
    public function chargeCreditCard(array $owner, $amount, $payments = 1)
    {
        // TODO: Implement chargeCreditCard() method.
    }

    /**
     * Refund the credit card
     *
     * @param array $owner
     * @param float $amount
     * @param int $payments
     * @return mixed
     */
    public function refundCreditCard(array $owner, $amount, $payments = 1)
    {
        // TODO: Implement refundCreditCard() method.
    }

    /**
     * Get the credit card token
     *
     * @param int $number
     * @param int $month
     * @param int $year
     * @param int $cvv
     * @param int $identity
     * @return mixed
     */
    public function getCreditCardToken($number, $month, $year, $cvv = null, $identity = null)
    {
        // TODO: Implement getCreditCardToken() method.
    }
}