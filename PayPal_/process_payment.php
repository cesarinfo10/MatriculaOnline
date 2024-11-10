<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'paypal_config.php';

if (!defined('CURLOPT_SSLVERSION')) {
    define('CURLOPT_SSLVERSION', 6); // CURL_SSLVERSION_TLSv1_2
}

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

$fixedAmount = 10.00; // Precio fijo de 10.00 USD

$payer = new Payer();
$payer->setPaymentMethod('paypal');

$item = new Item();
$item->setName('Producto de ejemplo')
    ->setCurrency('USD')
    ->setQuantity(1)
    ->setPrice($fixedAmount); // Usar $fixedAmount en lugar de $_POST['amount']

$itemList = new ItemList();
$itemList->setItems(array($item));

$details = new Details();
$details->setSubtotal($fixedAmount); // Usar $fixedAmount en lugar de $_POST['amount']

$amountObj = new Amount();
$amountObj->setCurrency('USD')
    ->setTotal($fixedAmount) // Usar $fixedAmount en lugar de $_POST['amount']
    ->setDetails($details);

$transaction = new Transaction();
$transaction->setAmount($amountObj)
    ->setItemList($itemList)
    ->setDescription('Pago de ejemplo')
    ->setInvoiceNumber(uniqid());

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl("https://matriculate.umc.cl/sgu/MatriculaOnlineDesa/PayPal/execute_payment.php?success=true")
    ->setCancelUrl("https://matriculate.umc.cl/sgu/MatriculaOnlineDesa/PayPal/execute_payment.php?success=false");

$payment = new Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions(array($transaction));

try {
    $payment->create($apiContext);
    header('Location: ' . $payment->getApprovalLink());
} catch (Exception $ex) {
    echo 'Error: ' . $ex->getMessage();
}