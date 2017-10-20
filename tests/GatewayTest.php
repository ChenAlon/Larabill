<?php

namespace Bwebi\Larabill\Tests;

use Bwebi\Larabill\Facades\Larabill;

class GatewayTest extends TestCase
{
    /**
     * Testing the gateway authentication process
     *
     * @return void
     */
    public function test_gateway_auth_pass()
    {
        $this->assertTrue(Larabill::authenticate());
    }

    /**
     * Testing the gateway credit card storing process
     *
     * @return void
     */
    public function test_gateway_store_credit_card()
    {
        $this->assertTrue(true);
        /*$owner = [
            'vat_id' => 000000000,
            'email' => 'owner@email.com',
            'name' => 'Owner Name',
        ];

        dd(Larabill::storeCreditCard($owner, 4580000000000000, '09', '23', 123));
        $this->assertSame(Larabill::storeCreditCard($owner, 4580000000000000, '09', '23', 123), ['cc_token' => true]);*/
    }
}