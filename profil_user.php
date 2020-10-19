<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier votre profil</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="styles/css/style.css">
</head>

<body>
<?php
include 'src/Base.php';
$user = new Base\profil_utilisateurs();

if(isset($_SESSION['id'])) {
    $user->getUser();
}
?>
    <form action="action.php" id="form" class="form form-ajax" method="post">
        <div class="form-control">
            <h1 class="titre">Modifier son profil</h1>
            <label for="nom">Nom :<?= $user->nom ?> </label>
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <div class="form-control">
            <label for="prenom">Nouveau nom : </label>
            <input type="text" id="nom" name="nom" value="<?= $user->nom ?>" class="input">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <div class="form-control">
            <label for="prenom">Prenom :<?= $user->prenom ?> </label>
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <div class="form-control">
            <label for="prenom">Nouveau prenom : </label>
            <input type="text" id="prenom" name="prenom" value="<?= $user->prenom ?>" class="input">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <div class="form-control">
            <label for="email"> Email : <?= $user->email ?></label>
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
        </div>
             <div class="form-control">
            <label for="email">Nouveau email :</label>
            <input type="email" id="email" name="email" value="<?= $user->email ?>" class="input">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <div class="form-control">
            <label for="telephone">Numéro : <?= $user->telephone ?> </label>
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <div class="form-control">
            <label for="telephone">Nouveau numéro : </label>
            <input type="text" id="telephone" name="telephone" value="<?= $user->telephone ?>" class="input">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <input type="hidden" value="change_profil_email" name="type" class="input">
        <button type="submit">Confirmer</button>
    </form>
    </main>
</body>
<script src="script.js"></script>
</html>
