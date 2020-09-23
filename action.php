<?php
session_start();
$url = "";
include 'src/Base.php';
$account = new Base\register_connexion();

if ($_POST['type'] == "inscription") {
    $url = "connexion.php";
    $account->register();
}

if ($_POST['type'] == "connexion") {
    $url = "index.php";
    $account->connexion();
}


echo json_encode([$url, $error]);


