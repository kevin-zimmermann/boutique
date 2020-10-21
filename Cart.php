<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/css/fa.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
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
                            <th scope="col">Modifier</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($carts->getPanier() as $cart) { ?>
                            <tr class="table-ajax">
                                <td><img width="49px" src="data/product_img/<?= $cart['produit_id'] ?>.jpg" alt="<?= $cart['nom_produit'] ?>"></td>
                                <td><?= $cart['nom_produit'] ?></td>
                                <td><?= strtoupper($cart['size'])?></td>
                                <td><?= $cart['quantity'] ?></td>
                                <td><?= $cart['prix'] ?></td>
                                <td class="ajax-delete" data-id="<?= $cart['produit_id'] ?>" data-name="product_id"><i
                                            class="fas fa-trash"></i></td>
                                <td><a href="admin_modif_product.php?produit_id=<?= $cart['produit_id'] ?>"><i
                                                class="fas fa-pen"></i></a></td>
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