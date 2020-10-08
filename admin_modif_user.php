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
<form action="actionAdmin.php?user_id=<?= $admin->id ?>" method="post" id="form" class="form form-ajax">
    <label for="name">Nouveau nom</label>
    <input type="text" name="nom" id="name" value="<?= $admin->nom ?>">
    <label for="prenom">Nouveau prenom</label>
    <input type="text" name="prenom" id="prenom" value="<?= $admin->prenom ?>">
    <label for="email">Nouveau email</label>
    <input type="email" name="email" id="email" value="<?= $admin->email ?>">
    <label for="telephone">Nouveau numéro de telephone</label>
    <input type="text" name="telephone" id="telephone"  value="<?= $admin->telephone ?>">

    <?php if($admin->id != $_SESSION['id']) { ?>
        <label for="admin">Admin?</label>
        <input type="checkbox" name="admin" id="admin" <?= $admin->admin ? 'checked' : '' ?>>
    <?php } ?>
    <input type="hidden" name="type" value="modifAdminUser">
    <button type="submit">Valider <i class="fas fa-check"></i></button>
</form>
    <script src="script.js"></script>
</main>
</body>
<?php include 'footer.php' ?>

</html>
