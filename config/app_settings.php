<?php

return [
    'emailprofile' => 'default',
    'emailfrom' => ['noreply@variantsol.com' => 'Green Cloud No-Reply'],
//    'emailfrom' => 'noreply@variantsol.com',
    'user_noemail' => 'noemail@variantsol.com',

    'should_email_default' => 0,
    'should_sms_default' => 0,
    'payment_type_id_default' => 1,

    'default_payment_structure' => 3,
    'default_loyalty_program' => 1,
    'merchant_free_credits' => 30,
    'payment_types' => [
        'Check' => 'Check',
        'Cash' => 'Cash',
        'Direct Deposit' => 'Direct Deposit',
        'Online Transfer' => 'Online Transfer',
        'PayPal' => 'PayPal',
    ],
    'payment_statuses' => [
        'Canceled_Reversal' => 'Canceled_Reversal',
        'Completed' => 'Completed',
        'Created' => 'Created',
        'Denied' => 'Denied',
        'Expired' => 'Expired',
        'Failed' => 'Failed',
        'Pending' => 'Pending',
        'Refunded' => 'Refunded',
        'Reversed' => 'Reversed',
        'Processed' => 'Processed',
        'Voided' => 'Voided'
    ],

    'allowed_mechant_roles' => [1, 2],    //Used to determine what roles a merchant should be able to switch to
    'discount_types' => ['$', '%'],


    'over_creddits_expire_days' => 7,    //How many days should the system wait before deactivating accounts which exceed credits

    'local_ips' => ['::1', '127.0.0.1', '45.63.105.79'],     //List of local IP addresses

    'web_signer_url' => env('WEB_SIGNER_URL', 'https://gcsign-web.herokuapp.com'),

    'currency' => [
        'currency_list' => [
            'CAD' => 'CAD',
            'JMD' => 'JMD',
            'USD' => "USD   ",
        ],
        'api_key' => 'd209fc1a3dff4945b496b1d2778ea741'
    ]
];
