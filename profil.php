<html lang="fr">

<head>
     <meta charset="utf-8">     
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier votre profil</title>
    <link rel="stylesheet" href="style.css">
    </head>
<body> 
    <div class="error">
    <?php

include 'src/Base.php'; 
    $user = new Base\profil_utilisateurs;
    var_dump($user->test);
    $user->tests = "kkjckjlkj";
    var_dump($user->tests);
    ?>
    </div>
    <form action="action.php" id="form" class="form form-ajax" method="post">
        <div class="form-control">
            <h1 class="titre">Modifier profil</h1>
            <label for="password">Nom : </label>
            <input type="password" id="password" name="nom">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div class="form-control">
        <label for="password">Prenom : </label>
        <input type="password" id="password" name="prenom">
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
        </div>
        <div class="form-control">
        <label for="email">Nouveau email : </label>
        <input type="email" id="email" name="email">
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <small>Error message</small>
        </div>
        <div class="form-control">
            <label for="password">Votre ancien mot de passe : </label>
            <input type="password" id="password" name="password">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div class="form-control">
            <label for="password">Votre nouveau mot de passe : </label>
            <input type="password" id="password" name="new_password">
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