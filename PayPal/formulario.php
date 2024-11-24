<?php
$baseUrl = 'http://localhost/MatriculaOnlineDesaLocal/paypal';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pago</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <form id="form_pay">
        <!-- Valores requeridos -->
        <input type="hidden" name="business" value="sb-svris33793472@business.example.com">
        <input type="hidden" name="cmd" value="_xclick">

        <label for="item_name" class="form-label">item_name</label>
        <input type="text" name="item_name" id="" value="Lampara de escritorio" required=""><br>

        <label for="amount" class="form-label">amount</label>
        <input type="text" name="amount" id="" value="13.00" required=""><br>

        <input type="hidden" name="currency_code" value="USD">

        <label for="quantity" class="form-label">quantity</label>
        <input type="text" name="quantity" id="" value="2" required=""><br>

        <!-- Valores opcionales -->
        <input type="hidden" name="item_number" value="1">
        <input type="hidden" name="lc" value="es_ES">
        <input type="hidden" name="no_shipping" value="1">
        <input type="hidden" name="image_url" value="https://matriculate.umc.cl/sgu/MatriculaOnline/login/assets/img/logo-universidad-miguel-de-cervantes-umc.png">
        <input type="hidden" name="return" value="<?= $baseUrl ?>/receptor.php">
        <input type="hidden" name="cancel_return" value="<?= $baseUrl ?>/pago_cancelado.php">

        <hr>

        <button type="button" onclick="submitForm()">Pagar ahora con Paypal!</button>
    </form>

    <script>
        function submitForm() {
            $.ajax({
                url: 'process_payment.php',
                type: 'POST',
                data: $('#form_pay').serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.paypal_url) {
                        window.location.href = response.paypal_url;
                    } else {
                        alert('Error al generar la URL de PayPal.');
                    }
                },
                error: function() {
                    alert('Error en la solicitud AJAX.');
                }
            });
        }
    </script>
</body>
</html>