<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/css/fa.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
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
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <title> Accueil - Foo2Foot</title>
</head>
<body>
<?php include 'header.php' ?>
<?php
$carts = new Base\actionPanier();
$product = new \Base\product__cat();

?>
<main>
    <h1>Charge <?php echo $carts->getPrice()[0] ?>€ with Stripe</h1>
    <div class="container">
        <h1 class="title"> Paiement Stripe</h1>

        <div class="group">
            <i class="fab fa-cc-mastercard"></i>
            <i class="fab fa-cc-visa"></i>
        </div>

        <span class="payment-errors"></span>

        <form action="submit.php" method="POST" id="paymentFrm">
            <div class="form">
                <label>Nom</label>
                <input class="paie" type="text" name="name" size="50" placeholder="Nom sur la carte"/>
            </div>
            <div class="form">
                <label>Email</label>
                <input class="paie" type="text" name="email" size="50" placeholder="Votre@email.com"/>
            </div>
            <div class="form">
                <label>Numéro de carte</label>
                <input class="paie" type="text" name="card_num" size="20" autocomplete="off" class="card-number"
                       placeholder="5555555555554444"/>
            </div>
            <div class="form">
                <label>CVC</label>
                <input class="paie" type="text" name="cvc" size="4" autocomplete="off" class="card-cvc"
                       placeholder="123"/>
            </div>
            <div class="form">
                <label>Expire le </label>
                <div class="group">
                    <input class="paie" type="number" max="12" min="01" name="exp_month" size="2"
                           class="card-expiry-month" placeholder="MM"/>
                    <input class="paie" type="number" max="99" min="0" name="exp_year" size="4" class="card-expiry-year" placeholder="YY"/>
                </div>
            </div>
            <button class="btn-dark" type="submit" id="payBtn">Valider le paiement</button>
        </form>
    </div>
</main>
<?php include 'footer.php' ?>
</body>
</html>
<script type="text/javascript">
    //set your publishable key
    Stripe.setPublishableKey('Your_API_Publishable_Key');

    //callback to handle the response from stripe
    function stripeResponseHandler(status, response) {
        if (response.error) {
            //enable the submit button
            $('#payBtn').removeAttr("disabled");
            //display the errors on the form
            $(".payment-errors").html(response.error.message);
        } else {
            var form$ = $("#paymentFrm");
            //get token id
            var token = response['id'];
            //insert the token into the form
            form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
            //submit form to the server
            form$.get(0).submit();
        }
    }

    $(document).ready(function () {
        //on form submit
        $("#paymentFrm").submit(function (event) {
            //disable the submit button to prevent repeated clicks
            $('#payBtn').attr("disabled", "disabled");

            //create single-use token to charge the user
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);

            //submit from callback
            return false;
        });
    });
</script>
