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
    <div class="error"></div>
<form action="action.php" method="post" id="form" class="form form-ajax">
    <div class="form-control">
    <h1 class="titre">INSCRIPTION</h1>
        <label for="prenom">Votre prénom</label>
        <input type="text" id="prenom" name="prenom">
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </div>
    <div class="form-control">
        <label for="nom">Votre nom</label>
        <input type="text" id="nom" name="nom">
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </div>
    <div class="form-control">
        <label for="email">Votre email</label>
        <input type="email" id="email" name="email">
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </div>
    <div class="form-control">
        <label for="phone">Votre numéro de téléphone</label>
        <input type="text" id="telephone" name="telephone">
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </div>
    <div class="form-control">
        <label for="password">Votre mot de passe</label>
        <input type="password" id="password" name="password">
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </div>
    <div class="form-control">
        <label for="confpassword">Confirmer mot de passe</label>
        <input type="password" id="confpassword" name="confpassword">
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </div>
    <input type="hidden" value="inscription" name="type">
    <button type="submit">Submit</button>
</form>

</main>

</body>
</html>
<script src="script.js"></script>