<?php

return [
    'gateway' => env('LARABILL_GATEWAY', 'icount'),

    'gateways' => [
        'icount' => [
            // Test ICount Account
            'username' => 'api3',
            'company'  => 'bwebiapi',
            'password' => '490317',
            'endpoint' => 'https://api.icount.co.il/api/v3.php/',
        ],
    ],

];
