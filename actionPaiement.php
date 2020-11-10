<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/css/fa.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/css/headerfooter.css">
    <link rel="stylesheet" href="styles/css/admin.css">
    <script src="https://js.stripe.com/v3/"></script>
    <title> Panel admin - Foo2Foot</title>
</head>
<body>
<?php include 'header.php' ?>
<?php include 'config.php' ?>
<?php
$cart = new \Base\discount();

?>
<?php
//check whether stripe token is not empty
    if(!empty($_POST)) {
    //get token, card and user info from the form
    $token = $_POST['stripeToken'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $card_num = $_POST['card_num'];
    $card_cvc = $_POST['cvc'];
    $card_exp_month = $_POST['exp_month'];
    $card_exp_year = $_POST['exp_year'];
    $adresseId = $_POST['adresse'];
    $price = $cart->getPanierPrice()['prix_reduc'];
    $id = $_SESSION['id'];
    $telephone = $_POST['telephone'];
    //include Stripe PHP library
    require_once('stripe-php/init.php');

    //set api key
    $stripe = array(
        "secret_key" => "sk_test_51HgTpGLtuZgtK0iJZZNbHgCWcswe92aWJOGIeK5hFTUZ7wRUXQQDzSQTTWLjGoSVY0O978roeY5A0RyIiiomZlPN00xDfUp1w5",
        "publishable_key" => "pk_test_51HgTpGLtuZgtK0iJM6Z9TRzIP0sywAv38DodZRUWHN3ZOg48fOrT5aNLdZNgEYvlQzvqzymxpIMQ76Udecu3NZpb0088vaq92Y");


    \Stripe\Stripe::setApiKey($stripe['secret_key']);

    //add customer to stripe
    $customer = \Stripe\Customer::create(array(
        'email' => $email,
        'source' => $token,
        'address' => ["city" => 'd', "country" => 'd', "line1" => 'd', "line2" => "d", "postal_code" => 'd', "state" => 'd']
    ));
    //item information
    $itemName = "Commande chez Foo 2 Foot";
    $itemNumber = "1";
    $itemPrice = $cart->getPanierPrice()['prix_reduc'] * 100;
    $currency = "eur";
    $orderID = "HISUH3450";

    //charge a credit or a debit card
    $charge = \Stripe\Charge::create(array(
        'customer' => $customer->id,
        'amount' => $itemPrice,
        'currency' => $currency,
        'description' => $itemName,
    ));
    //retrieve charge details
    $chargeJson = $charge->jsonSerialize();

    //check whether the charge is successful
    if ($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1) {
        //order details
        $amount = $chargeJson['amount'];
        $balance_transaction = $chargeJson['balance_transaction'];
        $currency = $chargeJson['currency'];
        $payment_status = $chargeJson['status'];


        //insert tansaction data into the database
        $insert = $cart->query('INSERT INTO commandes (utilisateur_id,adresse_id,creationdate,prix,statut) VALUES (?,?,?,?,?)', [
            $id,
            $adresseId,
            time(),
            $price,
            $payment_status
        ]);
        $last_insert_id = $cart->lastInsertId();
        $cart->updateStock($last_insert_id);
        //if order inserted successfully
        if ($last_insert_id && $payment_status == 'succeeded') {
            $statusMsg = "<h2>The transaction was successful.</h2><h4>Order ID: {$last_insert_id}</h4><a href='index.php'>Retour à l'accueil</a>";
        } else {
            $statusMsg = "Transaction has been failed";
        }
    } else {
        $statusMsg = "Transaction has been failed";
    }
} else {
    $statusMsg = "Form submission error.......";
}

//show success or error message
echo $statusMsg;