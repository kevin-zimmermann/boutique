<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/css/fa.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" a
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/css/headerfooter.css">
    <link rel="stylesheet" href="styles/css/admin.css">

    <title> Panel admin - Foo2Foot</title>
</head>
<?php include 'header.php' ?>
<body>
<?php

use Base\Profil;


$data = new DateTime();
$commande = new Base\commande();

if (!isset($_SESSION['id'])) {
    header('location:index.php');
}
?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">Récap produit</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">id_com</th>
                                <th scope="col">nom_produit</th>
                                <th scope="col">Quantité</th>
                                <th scope="col">Taille</th>
                                <th scope="col">Prix</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($commande->getCommande() as $product) { ?>
                                <tr class="table-ajax">
                                    <th scope="row"><?= $product['commande_id'] ?></th>
                                    <td><?= $product['nom_produit'] ?></td>
                                    <td><?= $product['quantité'] ?></td>
                                    <td><?= strtoupper($product['taille']) ?></td>
                                    <td><?= $product['prix'] ?>€</td>
                                </tr>
                            <?php } ?>
                            </tbody>
                            <div class="print-price">
                                <h2>Prix TTC:</h2>
                                <p><?php echo $commande->priceCommande()[0]['prix']?>€</p>
                            </div>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
<?php include 'footer.php' ?>


</html>
