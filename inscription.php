<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="styles/css/style.css">
</head>
<body>
<main>
<form action="action.php" method="post" id="form" class="form form-ajax">
    <div class="form-control">
    <h1 class="titre">INSCRIPTION</h1>
        <label for="prenom">Prénom</label>
        <input type="text" id="prenom" name="prenom" class="input">
    </div>
    <div class="form-control">
        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom" class="input">
    </div>
    <div class="form-control">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" class="input">
    </div>
    <div class="form-control">
        <label for="phone">Numéro de téléphone</label>
        <input type="text" id="telephone" name="telephone" class="input">
    </div>
    <div class="form-control">
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" class="input">
    </div>
    <div class="form-control">
        <label for="confpassword">Confirmer mot de passe</label>
        <input type="password" id="confpassword" name="confpassword" class="input">
    </div>
    <div class="error"></div>
    <input type="hidden" value="inscription" name="type" class="input">
    <button type="submit">Envoyer</button>
</form>
</main>
</body>
</html>
<script src="script.js"></script>