
<?php

$url = "";
include 'src/Base.php';
$account = new Base\register_connexion();
$error = [];
if(in_array($_POST['type'], ['inscription', 'connexion']))
{
    $account = new Base\register_connexion();
    if ($_POST['type'] == "inscription") {
        $url = "connexion.php";
        $error = $account->register();
    }

    if ($_POST['type'] == "connexion") {
        $url = "index.php";
        $error = $account->connexion();
    }
}
if($_POST['type'] == 'change_profil_email')
{
    $profil = new Base\profil_utilisateurs;
    $profil->change();
}

echo json_encode([$url, $error]);


