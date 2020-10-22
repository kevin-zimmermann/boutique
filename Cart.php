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
$product= new \Base\product__cat();

?>
<main>
    <div class="container">
        <div class="row justify-content-center">
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Nom produit</th>
                            <th scope="col">Taille</th>
                            <th scope="col">Quantité</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Supprimer</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($carts->getPanier() as $cart) {

                            $stock = $carts->setSize($cart['size'], $cart['produit_id']);
                            ?>
                            <tr class="table-ajax">
                                <td><img width="49px" src="data/product_img/<?= $cart['produit_id'] ?>.jpg" alt="<?= $cart['nom_produit'] ?>"></td>
                                <td><?= $cart['nom_produit'] ?></td>
                                <td><?= strtoupper($cart['size'])?></td>
                                <td><select class="qte" data-product-id="<?= $cart['produit_id'] ?>" data-size="<?= $cart['size'] ?>">
                                        <?php for ($i = 1; $i <= $stock->stock; ++$i) {?>
                                            <option value="<?= $i ?>" <?= $i == $cart['quantity'] ? 'selected' : '' ?>>
                                                <?= $i ?>
                                            </option>
                                        <?php } ?>
                                    </select></td>
                                <td><?= $cart['prix'] ?></td>
                                <td class="ajax-delete" data-id="<?= $cart['produit_id'] ?>" data-name="product_id"><i
                                            class="fas fa-trash"></i></td>
                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                    <button class="btn btn-dark"><a href=".php">Passer commande</a></button>
                </div>
        </div>
    </div>
</main>
<?php include 'footer.php' ?>
</body>
</html>
<script>
    $('.qte').change(function () {
        let value = $(this).val()
        let productId = $(this).data('product-id');
        let size = $(this).data('size');
        $.ajax({
            url : 'size.php',
            method : 'POST',
            data : {
                productId : productId,
                size : size,
                value : value
            },
            success : (data) =>{

            }

        })
    })
</script>