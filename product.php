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
    <link rel="stylesheet" href="styles/css/boutique.css">
    <title> Accueil - Foo2Foot</title>
</head>
<body>
<?php include 'header.php' ?>
<?php
$product = new Base\product__cat();
$product = $product->setProduct();
$size = $product->getSizes();
?>
<main>
    <div class="cards-list">
        <?php foreach ($product-> setProduct() as $product) { ?>
        <div class="card-desk-content">
            <div class="card">
                <img class="card-img-top" src="data/product_img/<?= $product->produit_id ?>.jpg"
                     alt="<?= $product->nom_produit ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $product->nom_produit ?></h5>
                    <p><?= $product->description ?></p>
                    <form action="action.php" id="form" class="form form-ajax-other" method="post">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Choisir taille:</label>
                            <select class="form-control" id="exampleFormControlSelect1" class="input">
                                <option value="s">S</option>
                                <option value="m">M</option>
                                <option value="l">L</option>
                                <option value="xl">XL</option>
                            </select>
                            <?php } ?>
                        </div>
                        <?php
                        var_dump($size);
                        ?>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Choisir quantité:</label>
                            <select class="form-control" id="exampleFormControlSelect1" class="input">
                                <?php
                                $i = 0;
                                while ($i < 30) {
                                    $i++; ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <h5 class="card-title-prix"><?= $product->prix ?>€</h5>
                </div>
                <a class="footer-product">
                    <input type="hidden" name="type" value="panierAdd" class="input">
                    <a href="addpanier.php?produit_id=<?= $product->produit_id ?>"<button type="submit" class="btn btn-primary">Ajouter au panier</button></a>
                </div>
                </form>
            </div>
        </div>

    </div>

</main>
<?php include 'footer.php' ?>
</body>
</html>