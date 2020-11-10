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
    <title> Accueil - Foo2Foot</title>
</head>
<body>
<?php include 'header.php' ?>
<?php
$carts = new Base\actionPanier();
$product = new \Base\product__cat();
$discount = new \Base\discount();

?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Nom produit</th>
                            <th scope="col">Taille</th>
                            <th scope="col">Quantité</th>
                            <th scope="col">Prix unité</th>
                            <th scope="col">Prix total</th>
                            <th scope="col">Supprimer</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($carts->getPanier() as $cart) {

                            $stock = $carts->setSize($cart['size'], $cart['produit_id']);
                            $onep = $carts->onePrice($cart['produit_id']);
                            ?>
                            <tr class="table-ajax">
                                <td><img width="49px" src="data/product_img/<?= $cart['produit_id'] ?>.jpg"
                                         alt="<?= $cart['nom_produit'] ?>"></td>
                                <td><?= $cart['nom_produit'] ?></td>
                                <td><?= strtoupper($cart['size']) ?></td>
                                <td><select class="qte" data-product-id="<?= $cart['produit_id'] ?>"
                                            data-size="<?= $cart['size'] ?>">
                                        <?php for ($i = 1; $i <= $stock->stock; ++$i) { ?>
                                            <option value="<?= $i ?>" <?= $i == $cart['quantity'] ? 'selected' : '' ?>>
                                                <?= $i ?>
                                            </option>
                                        <?php } ?>
                                    </select></td>
                                <td><?= $cart['prix'] ?>€</td>
                                <td><?= $onep ?>€</td>
                                <td class="ajax-delete" data-id="<?= $cart['panier_id'] ?>" data-name="panier_id"><i
                                            class="fas fa-trash"></i></td>
                            </tr>
                        <?php } ?>

                        <div class="get-delete get-popup">
                            <div class="get-delete-inner get-popup-inner">
                                <h3>Confirmation <a class="overlay-popup close-popup-delete" href=""></a></h3>
                                <div class="content-delete">
                                    Supprimer cette élément ?
                                </div>
                                <div class="conf">
                                    <form action="action.php" class="action-ajax" method="post">
                                        <input type="hidden" name="type" value="deleteProductcart">
                                        <input type="hidden" class="action-input-hidden">
                                        <button class="btn btn-primary">Supprimer</button>
                                    </form>

                                </div>
                            </div>

                        </div>
                        <div class="get-error get-popup">
                            <div class="get-error-inner r get-popup-inner">
                                <h3>Oops il y a une erreur <a class="overlay-popup close-popup-error" href=""></a></h3>
                                <div class="content-error">
                                    Supprimer cette élément ?
                                </div>
                            </div>
                        </div>

                </div>
                </tbody>
                </table>
                <div class="print-price">
                    <h2>Prix TTC:</h2>
                    <p><?php echo $carts->getPrice()[0] ?>€</p>
                </div>
                <button class="btn btn-dark validpanier">Passer commande</button>
            </div>
        </div>
    </div>
</main>
<?php include 'footer.php' ?>
</body>
</html>
<script>
    $('.validpanier').click(function () {
        $.ajax({
            url: 'action.php',
            method: 'POST',
            dataType: 'json',
            data: {
                type: 'checkprice'
            },
            success: (data) => {
                console.log(data)
                window.location.replace('paiement.php')
            }
        })
    })

    function leavePopup(getPopup) {
        getPopup.animate({opacity: 0}, {duration: 100}).delay(100).queue(function (next) {
            $(this).removeClass('active-overlay');
            next();
        })
    }

    $('.ajax-delete').click(function () {
        $('.get-delete').addClass('active-overlay');
        $('.get-delete').animate({opacity: 1}, {duration: 100});
        $('.get-delete').find('.action-input-hidden')
            .attr('name', $(this).data('name'))
            .val($(this).data('id'));
    })
    $('.action-ajax').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: (data) => {
                $('[data-id=' + data['return'] + ']').closest('.table-ajax').remove();
                leavePopup($('.get-delete'));
            },
            error: (error) => {
                console.log(error.responseText)
            }
        });
        return false;
    });
    $('.get-popup').click(function (e) {
        let div = $(this).find('.get-popup-inner');
        if (!$(e.target).is(div) && !$.contains(div[0], e.target)) {
            leavePopup($(this));
        }
    });
    $('.overlay-popup').click(function () {
        leavePopup($(this).closest('.get-popup'));
        return false;
    });
    $('.qte').change(function () {
        let value = $(this).val()
        let productId = $(this).data('product-id');
        let size = $(this).data('size');
        $.ajax({
            url: 'size.php',
            method: 'POST',
            data: {
                productId: productId,
                size: size,
                value: value
            },
            success: (data) => {

            }

        })
    })
</script>