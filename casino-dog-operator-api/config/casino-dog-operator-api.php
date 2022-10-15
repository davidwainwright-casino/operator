<?php

// config for Wainwright/CasinoDogOperatorApi
return [

    'access' => [
      'key' => '1b3b88789f773c07349b52538fd18728',
      'secret' => 'SPwb7BaqmNkB',
  ],
    'test_settings' => [
        'start_balance' => 10000, // enter starting balance (integer in cents)
    ],

    /* Firewall is used within RestrictIpAddressMiddleware */
    'firewall' => [
        'https_only' => false, // redirect requests in http to https
        'restrict_callback' => false,
        'restrict_all_routes' => false, // restrict full app on ip
        'allowed_ip' => [
          '85.148.48.255',
          '127.0.0.1'
        ],
      ],

    'api_url' => 'https://01-dev-api.777.dog', /* api_url is the base url to contact, it should not end with slash */
    'endpoints' => [
      'create_session' => '/api/createSession',
	    'gameslist' => '/api/gameslist/all',
    ],
];

