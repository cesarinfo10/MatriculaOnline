<?php
require '../vendor/autoload.php';

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

$apiContext = new ApiContext(
    new OAuthTokenCredential(
        'YOUR_CLIENT_ID',     // ClientID
        'YOUR_CLIENT_SECRET'  // ClientSecret
    )
);

$apiContext->setConfig(
    array(
        'mode' => 'sandbox', // or 'live'
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => 'PayPal.log',
        'log.LogLevel' => 'FINE'
    )
);