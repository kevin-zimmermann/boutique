<!DOCTYPE html>
<html>
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
    <title> Panel admin - Foo2Foot</title>
</head>
<?php include 'header.php' ?>
<body>
<?php

use Base\Profil;

$user = new Base\profil_utilisateurs();
$admin = new Base\Admin();
$carts = new \Base\actionPanier();
$product= new \Base\product__cat();
$data = new DateTime();

if (!$user->isAdmin()) {
    header('location:index.php');
}
?>
<main>
    <h1 class="title"> Bienvenue dans le Panel Administration</h1>
    <button class="btn btn-dark"><a href="admin_user.php">Modifier/Supprimer compte</a></button>
    <button class="btn btn-dark"><a href="admin_product.php">Modifier/Supprimer/Ajouter produit</a></button>
    <button class="btn btn-dark"><a href="admin_categorie.php">Modifier/Supprimer/Ajouter catégorie</a></button>
    <button class="btn btn-dark"><a href="admin_reduction.php">Modifier/Supprimer coupon de réduction</a></button>

    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">Liste des commandes</div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#id_com</th>
                            <th scope="col">Date</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Supprimer</th>
                            <th scope="col">Modifier</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($carts->setPrice() as $cart) { ?>
                            <tr class="table-ajax">
                                <th scope="row"><?= $cart['commande_id'] ?></th>
                                <td><?= $data->setTimestamp($cart['creationdate'])->format('d/m/Y');?></td>
                                <td><?= $cart['nom'] ?></td>
                                <td><?= $cart['prenom'] ?></td>
                                <td><?= $cart['email'] ?></td>
                                <td><?= $cart['prix'] ?>€</td>
                                <td><?= $cart['statut'] ?></td>
                                <td class="ajax-delete" data-id="<?= $cart['commande_id'] ?>" data-name="commande_id"><i
                                            class="fas fa-trash"></i></td>
                                <td><a href="admin_modif_product.php?produit_id=<?= $cart['commande_id'] ?>"><i
                                                class="fas fa-pen"></i></a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
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
