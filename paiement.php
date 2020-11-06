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
$adress = new \Base\profil_utilisateurs();
$discount = new \Base\discount();
?>
<main>
    <h1>Charge <span class="price"> <?= $carts->getPanierPrice()['prix_reduc'] ?></span>€ with Stripe</h1>
    <div class="container-ombre">
        <h1 class="title"> Paiement Stripe</h1>

        <div class="group">
            <i class="fab fa-cc-mastercard"></i>
            <i class="fab fa-cc-visa"></i>
        </div>

        <span class="payment-errors"></span>
        <div class="form">
            <label for="reduc"> Coupon de réduction: </label>
            <input type="text paie" class="text-coupon" name="coupon" id="coupon">
            <button class="btn btn-dark coupon-verify">Valider coupon</a></button>
            <br/>
            <div class="error-return"></div>
        </div>
        <form action="actionPaiement.php" method="POST" id="paymentFrm">

            <div class="form">
                <label>Nom</label>
                <input class="paie" type="text" name="name" size="50" placeholder="Nom sur la carte"/>
            </div>
            <div class="form">
                <label>Email</label>
                <input class="paie" type="text" name="email" size="50" placeholder="Votre@email.com"/>
            </div>
            <div class="form">
                <label>Adresse de livraison:</label>
                <select name="adresse" id="adresse-select" class="paie">
                    <?php foreach ($adress->getAdress() as $adresse) { ?>
                        <option name="adresse_id"
                                value="<?= $adresse['adresse_id'] ?>"><?= $adresse['nom'] ?> <?= $adresse['prenom'] ?>  <?= $adresse['adresse'] ?> <?= $adresse['code_postal'] ?> <?= $adresse['ville'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form">
                <label>Numéro de téléphone:</label>
                <select name="telephone" id="telephone" class="paie">
                    <?php foreach ($adress->getAdress() as $adresse) { ?>
                        <option name="telephone"
                                value="<?= $adresse['telephone'] ?>"> <?= $adresse['telephone'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form">
                <label>Numéro de carte</label>
                <input class="paie card-number" type="text" name="card_num" size="20" autocomplete="off"
                       placeholder="5555555555554444"/>
            </div>
            <div class="form">
                <label>CVC</label>
                <input class="paie card-cvc" type="text" name="cvc" size="4" autocomplete="off"
                       placeholder="123"/>
            </div>


            <div class="form">
                <label>Expire le </label>
                <div class="group">
                    <input class="paie card-expiry-month" type="number" max="12" min="01" name="exp_month" size="2"
                           placeholder="MM"/>
                    <span class="esp"></span>
                    <input class="paie card-expiry-year" type="number" max="99" min="0" name="exp_year" size="4"
                           placeholder="YY"/>
                </div>
            </div>
            <button class="btn-dark-paie" type="submit" id="payBtn">Valider le paiement</button>
        </form>
    </div>
</main>
<?php include 'footer.php' ?>
</body>
</html>
<script type="text/javascript">
    $('.coupon-verify').click(function () {
        let coupon = $('.text-coupon').val();
        console.log(coupon)
        $.ajax({
            url: 'action.php',
            method: 'POST',
            dataType: 'json',
            data: {
                coupon: coupon,
                type: 'checkcoupon'
            },
            success: (data) => {
                console.log(data)
                $('.price').html(data['return'][0])
                $('.error-return').html(data['return'][1])
            },
            error: (error) => {
                console.log(error.responseText)
            }

        })
    })


    //set your publishable key
    Stripe.setPublishableKey('pk_test_51HgTpGLtuZgtK0iJM6Z9TRzIP0sywAv38DodZRUWHN3ZOg48fOrT5aNLdZNgEYvlQzvqzymxpIMQ76Udecu3NZpb0088vaq92Y');

    //callback to handle the response from stripe
    function stripeResponseHandler(status, response) {

        if (response.error) {
            //enable the submit button
            $('#payBtn').removeAttr("disabled");
            //display the errors on the form
            console.log(response.error)
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

            // ftech ou ajax
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
