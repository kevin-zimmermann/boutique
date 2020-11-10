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
    <link rel="stylesheet" href="styles/css/boutique.css">
    <title> Accueil - Foo2Foot</title>
</head>
<body>
<?php include 'header.php' ?>
<?php
$product = new Base\product__cat();
$header = new Base\Header();
?>
<main>
    <div class="all-cat">
        <ul>
            <?php foreach ($header->getCategories() as $categorie) { ?>
                <div class="print-cat">
                    <li id="one_cat">
                        <a class="link <?= $_GET['category_id'] == $categorie['categorie_id'] ? 'is-active' : '' ?>" href="boutique.php?category_id=<?= $categorie['categorie_id'] ?>"><?= $categorie['nom_categorie'] ?></a>
                    </li>
                </div>
            <?php } ?>
        </ul>
        <h2 class="value_cat"><?= $product->gettheCat()[0]['nom_categorie'] ?></h2>
    </div>
    <div class="cards-list">
        <?php foreach ($product->getProducts() as $product) { ?>
            <div class="card-desk-content">
                <div class="card">
                    <img class="card-img-top" src="data/product_img/<?= $product['produit_id'] ?>.jpg"
                         alt="<?= $product['nom_produit'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $product['nom_produit'] ?></h5>
                        <h5 class="card-title-prix"><?= $product['prix'] ?>€</h5>
                    </div>
                    <div class="footer-product">
                        <p class="card-text"></p>
                        <button type="button" class="btn btn-dark"><a class="lien" href="product.php?produit_id=<?= $product['produit_id'] ?>">Voir
                                plus</button>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

</main>
<?php include 'footer.php' ?>
</body>
</html>
