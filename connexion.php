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
</head>
<body>
<div class="error">

</div>
<form action="action.php" class="form-ajax" method="post">
    <label for="email">Email :</label>
    <input type="email" id="email" name="email" class="input">
    <label for="password">Password :</label>
    <input type="password" id="password" name="password" class="input">
    <input type="hidden" name="type" value="connexion" class="input">
    <button type="submit">Se connecter</button>
</form>
<script src="script.js"></script>
</body>

</html>