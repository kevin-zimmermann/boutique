<html lang="fr">

<head>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier votre profil</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="styles/css/style.css">
</head>
<body> 
<div class="error">
    <?php
    include 'src/Base.php';
    $user = new Base\profil_utilisateurs();
    ?>
</div>
<form action="action.php" id="form" class="form form-ajax" method="post">
    <div class="form-control">
        <h1 class="titre">Modifier son mot de passe</h1>
        <div class="form-control">
            <label for="password">Votre ancien mot de passe : </label>
            <input type="password" id="password" name="password" class="input">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <div class="form-control">
            <label for="password">Votre nouveau mot de passe : </label>
            <input type="password" id="password" name="new_password" class="input">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <div class="form-control">
            <label for="password">Confirmation du nouveau mot de passe : </label>
            <input type="password" id="password" name="new_password" class="input">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <input type="hidden" value="modif_password" name="type" class="input">
        <button type="submit">Confirmer</button>
</form>
</main>
</body>

</html>
<script src="script.js"></script>