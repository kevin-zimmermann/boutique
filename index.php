<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/css/fa.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
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
?>
<main>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <a href=""> <img class="d-block w-100"
                                 src="styles/image/jannes-glas-cuhQcfp3By4-unsplash.jpg" alt="First slide"></a>
            </div>
            <div class="carousel-item">
                <a href=""><img class="d-block w-100"
                                src="styles/image/arseny-togulev-xjnSIF9keGY-unsplash.jpg"
                                alt="Second slide"></a>
            </div>
            <div class="carousel-item">
                <a href=""> <img class="d-block w-100"
                                 src="styles/image/alvaro-mendoza-6dRiUBjRvsM-unsplash.jpg"
                                 alt="Third slide"></a>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-style-button carousel-prev-button"><i class="fas fa-chevron-left"></i> </span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-style-button carousel-nex-button"><i class="fas fa-chevron-right"></i> </span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <h1 class="top-title"> NOUVEAUX MAILLOTS 2020</h1>
    <div class="cards-list">
    <?php foreach ($product->getLastProducts() as $product) { ?>
    <div class="card-desk-content">
        <div class="card">
            <img class="card-img-top" src="data/product_img/<?= $product['produit_id'] ?>.jpg"  width="100px" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?= $product['nom_produit'] ?></h5>
                <h5 class="card-title-prix"><?= $product['prix'] ?>€</h5>
                <p class="card-text">Disponible dans la limite des stocks. Faite vite !</p>
                <button type="button" class="btn btn-dark"><a class="lien" href="product.php?produit_id=<?= $product['produit_id'] ?>">Voir plus </button></a>
            </div>
            <div class="card-footer">
                <small class="text-muted">Mis en ligne récemment</small>
            </div>
        </div>
      </div>
        <?php } ?>
    </div>
</main>
<?php include 'footer.php' ?>
</body>
</html>
