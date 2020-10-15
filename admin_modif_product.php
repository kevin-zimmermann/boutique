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
    <link rel="stylesheet" href="styles/css/style.css">
    <title> Panel admin - Foo2Foot</title>
</head>
<?php include 'header.php' ?>
<body>
<?php

use Base\Profil;

$user = new Base\profil_utilisateurs();
$admin = new Base\Admin();
$produit = new Base\product__cat();
if (!$user->isAdmin()) {
    header('location:index.php');
}
$product = $produit->setProduct();
?>
<main>
    <div class="container">
    <form action="actionAdmin.php?produit_id=<?= $product->produit_id ?>" method="post" id="form" class="form form-ajax" enctype="multipart/form-data">
        <div class="form-article">
        <label for="image">Ancienne image</label>
        <img width="49px" src="data/product_img/<?= $product->produit_id?>.jpg" alt="<?= $product->nom_produit ?>">
        </div>
        <div class="form-article">
        <input type="file" id="image" name="image" class="input">
        </div>
        <div class="form-article">
        <label for="categorie-select">Catégorie</label> <br/>
        <select name="categorie" id="categorie-select" class="input">
            <?php foreach ( $product->getCategorie() as $categorie) { ?>
                <option value="<?= $categorie['categorie_id']?>"><?= $categorie['nom_categorie'] ?></option>
            <?php } ?>
        </select>
        </div>
        <div class="form-article">
        <label for="nom_produit">Nouveau nom de produit</label>
        <input type="text" name="nom_produit" id="nom_produit" value="<?= $product->nom_produit ?>" class="input">
        </div>
        <label for="prix">Nouveau Prix</label>
        <input type="number" min="0" step="0.01" name="prix" value="<?= $product->prix ?>" class="input">
         <div class="form-article">
        <label for="description">Nouvelle description</label>
        <textarea type="text" name="description" id="description" value="<?= $product->description ?>" class="input">
        <?php foreach ( $product->getSizes() as $size) { ?>
            <label><?= strtoupper($size['taille']) ?></label>
            <input type="number" value="<?= $size['stock'] ?>" name="<?= $size['taille'] ?>" class="input">

        <?php } ?>
         </div>
        <input type="hidden" name="type" value="modifAdminProduct" class="input">
        <button type="submit">Valider <i class="fas fa-check"></i></button>
    </form>
    </div>
    <script src="script.js"></script>
</main>
</body>
<?php include 'footer.php'?>
</html>

