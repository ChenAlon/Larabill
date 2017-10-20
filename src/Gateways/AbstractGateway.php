<?php

namespace Bwebi\Larabill\Gateways;

use Bwebi\Larabill\Exceptions\GatewayException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class AbstractGateway
{
    /**
     * The Guzzle HTTP Client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * The gateway name.
     * should be the same as in the config file.
     *
     * @var string
     */
    protected $name;

    /**
     * The base API URL.
     *
     * @var string
     */
    protected $base_url;

    /**
     * API username.
     *
     * @var string
     */
    protected $username;

    /**
     *  API password.
     *
     * @var string
     */
    protected $password;

    /**
     *  API terminal.
     *
     * @var string
     */
    protected $terminal;

    /**
     * Construct the basic data.
     */
    public function __construct()
    {
        $this->client = new Client();
        $this->base_url = config('larabill.gateways.'.$this->name.'.endpoint');
    }

    /**
     * Creates and sends a POST request to the requested URL.
     *
     * @param $endpoint
     * @param array $options
     *
     * @throws GatewayException
     *
     * @return mixed
     */
    public function postRequest($endpoint, $options)
    {
        try {
            $response = $this->client->post($endpoint, $options);

            if ($response->getStatusCode() != 201 && $response->getStatusCode() != 200) {
                throw new GatewayException('Unable to request from Gateway.');
            }

            return $response;
        } catch (RequestException $e) {
        }
    }
}
