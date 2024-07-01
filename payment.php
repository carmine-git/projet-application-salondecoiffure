<?php

session_start();
require_once './stripe/init.php';

$stripeSecretKey = 'sk_test_51PVaZSEtFZQG5tspSL7h39JqUh7JpufhUiorLRIfm8a4Vk5s5RzE3N6KAo6wI2q0n59QOFp4WGtiIE8oSFXswZ7Q00pYjAjS8v';
\Stripe\Stripe::setApiKey($stripeSecretKey);

$checkoutSesison = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "http://localhost:3000/success.php",
    "line_items" => [
        [
            "quantity" => 1,
            "price_data" => [
                "currency" => "eur",
                "unit_amount" => $_SESSION['prestations_client']['prix_tot'] * 100,
                "product_data" => [
                    "name" => $_SESSION['prestations_client']['coupe_client'],
                ]
            ]
        ]
    ]
]);

http_response_code(303);
header('location: ' . $checkoutSesison->url);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>hello</h1>
</body>

</html>