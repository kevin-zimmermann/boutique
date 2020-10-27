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
$cart = new \Base\actionPanier();
?>

<?php
$payment_id = $statusMsg = '';
$ordStatus = 'error';
$id = $_SESSION['id'];

// Check whether stripe token is not empty
if(!empty($_POST['stripeToken'])){

// Retrieve stripe token, card and user info from the submitted form data
$token  = $_POST['stripeToken'];
$name = $_POST['name'];
$email = $_POST['email'];
$adresseId = $_POST['adresse_id'];
$price = $cart->getPrice()[0];

// Set API key
\Stripe\Stripe::setApiKey(STRIPE_API_KEY);

// Add customer to stripe
try {
$customer = \Stripe\Customer::create(array(
'email' => $email,
'source'  => $token
));
}catch(Exception $e) {
$api_error = $e->getMessage();
}

if(empty($api_error) && $customer){

// Convert price to cents
$itemPriceCents = ($itemPrice*100);

// Charge a credit or a debit card
try {
$charge = \Stripe\Charge::create(array(
'customer' => $customer->id,
'amount'   => $itemPriceCents,
'currency' => $currency,
));
}catch(Exception $e) {
$api_error = $e->getMessage();
}

if(empty($api_error) && $charge){

// Retrieve charge details
$chargeJson = $charge->jsonSerialize();

// Check whether the charge is successful
if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1){
// Transaction details
$transactionID = $chargeJson['balance_transaction'];
$paidAmount = $chargeJson['amount'];
$paidAmount = ($paidAmount/100);
$paidCurrency = $chargeJson['currency'];
$payment_status = $chargeJson['status'];

// Include database connection file
// Insert tansaction data into the database
$sql = "INSERT INTO commandes (utilisateur_id,adresse_id,creationdate,prix,statut) VALUES (".$id."','".$adresseId."','".time()."','".$price."','".$payment_status.")";
$insert = $this->query($sql);


// If the order is successful
if($payment_status == 'succeeded'){
$ordStatus = 'success';
$statusMsg = 'Your Payment has been Successful!';
}else{
$statusMsg = "Your Payment has Failed!";
}
}else{
$statusMsg = "Transaction has been failed!";
}
}else{
$statusMsg = "Charge creation failed! $api_error";
}
}else{
$statusMsg = "Invalid card details! $api_error";
}
}else{
$statusMsg = "Error on form submission.";
}
?>

<div class="container">
    <div class="status">
        <?php if(!empty($payment_id)){ ?>
            <h1 class="<?php echo $ordStatus; ?>"><?php echo $statusMsg; ?></h1>

            <h4>Payment Information</h4>
            <p><b>Reference Number:</b> <?php echo $payment_id; ?></p>
            <p><b>Transaction ID:</b> <?php echo $transactionID; ?></p>
            <p><b>Paid Amount:</b> <?php echo $paidAmount.' '.$paidCurrency; ?></p>
            <p><b>Payment Status:</b> <?php echo $payment_status; ?></p>

            <h4>Product Information</h4>
            <p><b>Price:</b> <?php echo $itemPrice.' '.$currency; ?></p>
        <?php }else{ ?>
            <h1 class="error">Your Payment has Failed</h1>
        <?php } ?>
    </div>
    <a href="index.php" class="btn-link">Back to Payment Page</a>
</div>
