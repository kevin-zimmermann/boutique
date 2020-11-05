<!DOCTYPE html>
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
    <link rel="stylesheet" href="styles/css/admin.css">

    <title> Panel admin - Foo2Foot</title>
</head>
<?php include 'header.php' ?>
<body>
<?php

use Base\Profil;

$user = new Base\profil_utilisateurs();
$admin = new Base\Admin();
$admin = $admin->setUser();
if (!$user->isAdmin()) {
    header('location:index.php');
}
?>
<main>
    <div class="container">
        <form action="actionAdmin.php?user_id=<?= $admin->id ?>" method="post" id="form" class="form form-ajax">
            <div class="form-article">
                <label for="name">Nouveau nom</label>
                <input type="text" name="nom" id="name" value="<?= $admin->nom ?>" class="input">
            </div>

            <div class="form-article">

                <label for="prenom">Nouveau prenom</label>
                <input type="text" name="prenom" id="prenom" value="<?= $admin->prenom ?>" class="input">
            </div>

            <div class="form-article">

                <label for="email">Nouveau email</label>
                <input type="email" name="email" id="email" value="<?= $admin->email ?>" class="input">
            </div>

            <div class="form-article">

                <label for="telephone">Nouveau numéro de telephone</label>
                <input type="text" name="telephone" id="telephone" value="<?= $admin->telephone ?>"
                       class="input">
            </div>


            <?php if ($admin->id != $_SESSION['id']) { ?>
                <div class="form-article">
                    <label for="admin">Admin?</label>
                    <input type="checkbox" name="admin" id="admin" <?= $admin->admin ? 'checked' : '' ?>
                           class="input">
                </div>
            <?php } ?>
            <div class="form-article">
                <input type="hidden" name="type" value="modifAdminUser" class="input">
                <button type="submit">Valider <i class="fas fa-check"></i></button>
            </div>
        </form>
    </div>
    <script src="script.js"></script>
</main>
</body>
<?php include 'footer.php' ?>
</html>
