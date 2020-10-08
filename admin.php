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
<body>
<?php include 'header.php' ?>
<?php

use Base\Profil;

$user = new Base\profil_utilisateurs();

if (!$user->isAdmin()) {
    header('location:index.php');
}
?>
<main>
    <div class="container">
    <h1 class="title"> Bienvenue dans le Panel Administration</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Liste des commandes en cours </div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Id_commande</th>
                                <th scope="col">Date</th>
                                <th scope="col">Prix</th>
                                <th scope="col">Quantité</th>
                                <th scope="col">Utilisateur</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>#</td>
                                <td>#</td>
                                <td>#</td>
                                <td>#</td>
                                <td>#</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>#</td>
                                <td>#</td>
                                <td>#</td>
                                <td>#</td>
                                <td>#</td>
                            </tr>
                            <tr class="table-ajax">
                                <th scope="row">3</th>
                                <td>#</td>
                                <td>#</td>
                                <td>#</td>
                                <td>#</td>
                                <td class="ajax-delete" data-id="12" data-name="user_id">#</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <button class="btn btn-primary">Ajout d'article</button>
    <div class="get-delete">
        <div class="get-error-inner">
            <h1>Confirmation</h1>
            <div class="content-delete">
                blabla
                <div class="conf">
                    <form action="actionDelete.php" class="action-ajax" method="post">
                        <input type="hidden" name="type" value="delete">
                        <input type="hidden" class="action-input-hidden">
                        <button class="btn btn-primary">button</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
<script>
    $('.ajax-delete').click(function () {
        $('.get-delete').css('display', 'block');
        $('.get-delete').find('.action-input-hidden')
            .attr('name', $(this).data('name'))
            .val($(this).data('id'))
    })
    $('.action-ajax').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url : $(this).attr('action'),
            method : $(this).attr('method'),
            data : $(this).serialize(),
            dataType : 'json',
            success : (data) => {
                console.log(data)
                $('.get-delete').css('display', 'none')
                $('[data-id=' + data['return'] + ']').closest('.table-ajax').remove()
            },
            error : (error) => {
                console.log(error)
            }
        });
        return false;
    });
</script>

</main>
</body>
<?php include 'footer.php' ?>

</html>
