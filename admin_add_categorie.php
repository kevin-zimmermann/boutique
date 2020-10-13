<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
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
<body>
<?php include 'header.php'?>
<?php

use Base\Profil;

$user = new Base\profil_utilisateurs();
$admin = new Base\Admin();
$product = new Base\product__cat();
if (!$user->isAdmin()) {
    header('location:index.php');
}
?>
<main>
    <h1 class="title"> Bienvenue dans le Panel Administration</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div >
                <div class="card">
                    <div class="card-header">Liste des commandes</div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#id</th>
                                <th scope="col">Nom catégorie</th>
                                <th scope="col">Supprimer</th>
                                <th scope="col">Modifier</th>
                            </tr>
                            </thead>
                            <tbody>
<!--                            <?php /*foreach ($product->getCategorie() as $categorie) {*/?>
                                <tr class="table-ajax">
                                    <th scope="row"><?/*= $categorie['id'] */?></th>
                                    <td><?/*= $categorie['prenom'] */?></td>
                                    <td><?/*= $categorie['nom'] */?></td>
                                    <td><?/*= $categorie['email'] */?></td>
                                    <td><?/*= $categorie['telephone'] */?></td>
                                    <td><?/*= $categorie['admin'] */?></td>
                                    <td class="ajax-delete" data-id="<?/*= $categorie['id'] */?>" data-name="categorie_id"><i class="fas fa-trash"></i></td>
                                    <td><a href="admin_modif_categorie.php?categorie_id=<?/*= $categorie['id'] */?>"><i class="fas fa-pen"></i></a></td>
                                </tr>
                            --><?php /*} */?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h1 class="title"> Ajouter une catégorie</h1>
        <form action="actionAdmin.php" id="form" class="form form-ajax" method="post">
            <div class="form-article">
                <label for="nom_categorie">Nom de la catégorie</label> <br/>
                <input type="text" id="nom_categorie" name="nom_categorie" >
            </div>
                <input type="hidden" value="addcategorie" name="type">
                <button type="submit">Envoyer</button>
            </div>
</form>
</main>
