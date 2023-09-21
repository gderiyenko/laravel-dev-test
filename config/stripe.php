<?php

return [

    'credentials' => [
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'products' => [
        'B2C' => [
            'id' => 'prod_OflXhq6uSPmcCx',
            'price_id' => 'price_1NsQ0gFvbQ4n1E6SqutnACF3',
        ],
        'B2B' => [
            'id' => 'prod_OflX7GJR1kOBlg',
            'price_id' => 'price_1NsQ01FvbQ4n1E6S2Q37Tv6l',
        ],
    ]

];
