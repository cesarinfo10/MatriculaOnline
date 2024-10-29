<?php
require 'paypal_config.php';

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

$payer = new Payer();
$payer->setPaymentMethod('paypal');

$item = new Item();
$item->setName('Producto de ejemplo')
    ->setCurrency('USD')
    ->setQuantity(1)
    ->setPrice($_POST['amount']);

$itemList = new ItemList();
$itemList->setItems(array($item));

$details = new Details();
$details->setSubtotal($_POST['amount']);

$amount = new Amount();
$amount->setCurrency('USD')
    ->setTotal($_POST['amount'])
    ->setDetails($details);

$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription('Pago de ejemplo')
    ->setInvoiceNumber(uniqid());

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl("http://yourwebsite.com/execute_payment.php?success=true")
    ->setCancelUrl("http://yourwebsite.com/execute_payment.php?success=false");

$payment = new Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions(array($transaction));

try {
    $payment->create($apiContext);
    header("Location: " . $payment->getApprovalLink());
    exit;
} catch (Exception $ex) {
    die($ex);
}