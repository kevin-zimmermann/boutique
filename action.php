<?php
session_start();
$url = "";
include 'src/Base.php';
$account = new Base\register_connexion();
$error = [];
if ($_POST['type'] == "inscription") {
    $url = "connexion.php";
    $error = $account->register();
}

if ($_POST['type'] == "connexion") {
    $url = "index.php";
    $error = $account->connexion();
}


echo json_encode([$url, $error]);


