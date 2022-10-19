<?php

// config for Wainwright/CasinoDogOperatorApi
return [

    'access' => [
      'key' => 'ee7759de0838471f7b8b18c9835403d4',
      'secret' => 'Mg04rH0VNrHp',
  ],
    'test_settings' => [
        'start_balance' => 25000, // enter starting balance (integer in cents)
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

    'api_url' => 'https://02-gameserver.777.dog', /* api_url is the base url to contact, it should not end with slash */
    'endpoints' => [
      'create_session' => 'https://02-gameserver.777.dog/api/createSession',
      'toggle_respin' => 'https://02-gameserver.777.dog/api/toggle_respin',
      'gameslist' => 'https://02-gameserver.777.dog/api/gameslist/all',
    ],
];

