<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
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
    <link rel="stylesheet" href="styles/css/admin.css">


    <title> Panel admin - Foo2Foot</title>
</head>
<body>
<?php include 'header.php' ?>
<?php

use Base\Profil;
$user = new Base\profil_utilisateurs();

if (!isset($_SESSION['id'])) {
    header('location:index.php');
}
/** @var Base\profil_utilisateurs $adress */
$adress = $user->setAdress();
?>
<main>
    <div class="container">
        <h1 class="title"> Formulaire produit</h1>
        <form action="action.php?adresse_id=<?= $adress->adresse_id ?>" id="form" class="form form-ajax" method="post">

            <div class="form-article">
                <label for="nom">Nom</label> <br/>
                <input type="text" id="nom" name="nom" value="<?= $adress->nom ?>" class="input">
            </div>
            <div class="form-article">
                <label for="prenom">Prenom</label> <br/>
                <input type="text" id="prenom" name="prenom" value="<?= $adress->prenom ?>" class="input">
            </div>
            <div class="form-article">
                <label for="des">Adresse</label> <br/>
                <textarea id="Adresse" name="adresse"  class="input"> <?= $adress->adresse ?> </textarea>
            </div>
            <div class="form-article">
                <label for="postal">Code Postal</label> <br/>
                <input type="text"  id="postal" name="postal" value="<?= $adress->code_postal ?>" class="input">
            </div>
            <div class="form-article">
                <label for="ville">Ville</label> <br/>
                <input type="text" id="ville" name="ville" value="<?= $adress->ville ?>" class="input" >
            </div>
            <div class="form-article">
                <label for="telephone">Téléphone</label> <br/>
                <input type="text" id="telephone" name="telephone" value="<?= $adress->telephone ?>" class="input">
            </div>
            <input type="hidden" value="editAddress" name="type" class="input">
            <button type="submit">Envoyer</button>
        </form>
    </div>
</main>
<?php include 'footer.php' ?>
</body>
</html>
<script src="script.js"></script>