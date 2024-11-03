<?php
require '../vendor/autoload.php';

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

$apiContext = new ApiContext(
    new OAuthTokenCredential(
        'AYxn80dVEPMP_EN5_J1ZYSl8cx5fAVEoOU_yluTM47LcMbDG0DS83DxdantidSW4nuQycBhcxiaN3C0H',     // ClientID
        'EN-Zv76e7y4IKzpU_HnyEbmUUCYNHcvVJTXc1UpHDMRMsqySPxGZCJwjHrw0zg9o9f8xbSCj4K4hKDeB'  // ClientSecret
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