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
        include 'src/Base/register_connexion.php';
        include 'src/Base/profil_utilisateurs.php';
        $user = new Profil;
        
        if(isset($_SESSION['id'])) {
            $user->getUser();
        }
        // var_dump($user->test);
        // $user->tests = "Hello";
        // var_dump($user->tests);
        var_dump($_SESSION);
        // session_destroy();
        ?>
    </div>
    <form action="action.php" id="form" class="form form-ajax" method="post">
        <div class="form-control">
            <h1 class="titre">Modifier son profil</h1>
            <label for="nom">Nom :<?= $_SESSION['nom'] ?> </label>
            <input type="txt" id="name" name="nom">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div class="form-control">
            <label for="prenom">Prenom :<?= $_SESSION['prenom'] ?> </label>
            <input type="txt" id="prenom" name="prenom">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div class="form-control">
            <label for="email"> Email : <?= $_SESSION['email'] ?></label>
            <input type="email" id="email" name="email">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
             <div class="form-control">
            <label for="email">Nouveau email :</label>
            <input type="email" id="email" name="email">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div class="form-control">
            <label for="email">Nouveau numéro : </label>
            <input type="" id="phone" name="phone">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <input type="hidden" value="inscription" name="type">
        <button type="submit">Confirmer</button>
    </form>
    </main>
</body>

</html>
<script src="script.js"></script>