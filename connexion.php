<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Javascript</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="error">

</div>
<form action="action.php" id="form" class="form form-ajax" method="post">
<div class="form-control">
    <h1 class="titre">CONNEXION</h1>
        <label for="email">Votre email : </label>
        <input type="email" id="email" name="email">
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </div>
    <div class="form-control">
        <label for="password">Votre mot de passe : </label>
        <input type="password" id="password" name="password">
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
    </div>
    <input type="hidden" name="type" value="connexion">
    <button type="submit">Se connecter</button>
</form>
<script src="script.js"></script>
</body>

</html>