<?php
// process_payment.php

// Recibe los datos del formulario
$business = $_POST['business'];
$item_name = $_POST['item_name'];
$amount = $_POST['amount'];
$currency_code = $_POST['currency_code'];
$quantity = $_POST['quantity'];
$item_number = $_POST['item_number'];
$lc = $_POST['lc'];
$no_shipping = $_POST['no_shipping'];
$image_url = $_POST['image_url'];
$return = $_POST['return'];
$cancel_return = $_POST['cancel_return'];

// Genera la URL de PayPal
$paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_xclick&business=$business&item_name=$item_name&amount=$amount&currency_code=$currency_code&quantity=$quantity&item_number=$item_number&lc=$lc&no_shipping=$no_shipping&image_url=$image_url&return=$return&cancel_return=$cancel_return";

// Devuelve la URL de PayPal
echo json_encode(['paypal_url' => $paypal_url]);
?>