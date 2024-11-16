<?php
require 'paypal_config.php';

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

if (isset($_GET['success']) && $_GET['success'] == 'true') {
    $paymentId = $_GET['paymentId'];
    $payment = Payment::get($paymentId, $apiContext);

    $execution = new PaymentExecution();
    $execution->setPayerId($_GET['PayerID']);

    try {
        $result = $payment->execute($execution, $apiContext);
        echo "Pago completado con éxito.";
    } catch (Exception $ex) {
        die($ex);
    }
} else {
    echo "El usuario canceló el pago.";
}