<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/css/fa.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" a
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

if (!isset($_SESSION['id'])) {
    header('location:index.php');
}
?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div>
                <div class="card">
                    <div class="card-header">Liste des adresses</div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#adresse_id</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Prenom</th>
                                <th scope="col">Adresse</th>
                                <th scope="col">Code postal</th>
                                <th scope="col">Ville</th>
                                <th scope="col">Telephone</th>
                                <th scope="col">Supprimer</th>
                                <th scope="col">Modifier</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($user->getAdress() as $adress) { ?>
                                <tr class="table-ajax">
                                    <th scope="row"><?= $adress['adresse_id'] ?></th>
                                    <td><?= $adress['nom'] ?></td>
                                    <td><?= $adress['prenom'] ?></td>
                                    <td><?= $adress['adresse'] ?></td>
                                    <td><?= $adress['code_postal'] ?></td>
                                    <td><?= $adress['ville'] ?></td>
                                    <td><?= $adress['telephone'] ?></td>
                                    <td class="ajax-delete" data-id="<?= $adress['adresse_id'] ?>" data-name="adresse_id"><i
                                            class="fas fa-trash"></i></td>
                                    <td><a href="profil_modif_adresse.php?adresse_id=<?= $adress['adresse_id'] ?>"><i
                                                class="fas fa-pen"></i></a></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <button class="btn btn-dark"><a href="profil_add_adress.php">Ajouter une adresse</a></button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="get-delete get-popup">
        <div class="get-delete-inner get-popup-inner">
            <h3>Confirmation <a class="overlay-popup close-popup-delete" href=""></a></h3>
            <div class="content-delete">
                blabla
            </div>
            <div class="conf">
                <form action="action.php" class="action-ajax" method="post">
                    <input type="hidden" name="type" value="deleteAddress">
                    <input type="hidden" class="action-input-hidden">
                    <button class="btn btn-primary">button</button>
                </form>

            </div>
        </div>

    </div>
    <div class="get-error get-popup">
        <div class="get-error-inner r get-popup-inner">
            <h3>Oops il y a une erreur <a class="overlay-popup close-popup-error" href=""></a></h3>
            <div class="content-error">
                blabla
            </div>
        </div>

    </div>
    <script>
        function leavePopup(getPopup) {
            getPopup.animate({opacity: 0}, {duration: 100}).delay(100).queue(function (next) {
                $(this).removeClass('active-overlay');
                next();
            })
        }

        $('.ajax-delete').click(function () {
            $('.get-delete').addClass('active-overlay');
            $('.get-delete').animate({opacity: 1}, {duration: 100});
            $('.get-delete').find('.action-input-hidden')
                .attr('name', $(this).data('name'))
                .val($(this).data('id'));
        })
        $('.action-ajax').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $(this).serialize(),
                dataType: 'json',
                success: (data) => {
                    console.log(data)
                    $('[data-id=' + data['return'] + ']').closest('.table-ajax').remove();
                    leavePopup($('.get-delete'));
                },
                error: (error) => {
                    console.log(error.responseText)
                }
            });
            return false;
        });
        $('.get-popup').click(function (e) {
            let div = $(this).find('.get-popup-inner');
            if (!$(e.target).is(div) && !$.contains(div[0], e.target)) {
                leavePopup($(this));
            }
        });
        $('.overlay-popup').click(function () {
            leavePopup($(this).closest('.get-popup'));
            return false;
        });
    </script>

</main>
</body>
<?php include 'footer.php' ?>

</html>

