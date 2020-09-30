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
            <label for="nom">Nom : <?= $user->nom ?> </label>
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div class="form-control">
            <label for="prenom">Nouveau nom : </label>
            <input type="text" id="nom" name="nom">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div class="form-control">
            <label for="prenom">Prenom :<?= $user->prenom ?> </label>
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div class="form-control">
            <label for="prenom">Nouveau prenom : </label>
            <input type="text" id="prenom" name="prenom">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div class="form-control">
            <label for="email"> Email : <?= $user->email ?></label>
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
            <label for="telephone">Numéro : <?= $user->telephone ?> </label>
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div class="form-control">
            <label for="telephone">Nouveau numéro : </label>
            <input type="" id="telephone" name="telephone">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <input type="hidden" value="change_profil_email" name="type">
        <button type="submit">Confirmer</button>
    </form>
    </main>
</body>

</html>
<script src="script.js"></script>