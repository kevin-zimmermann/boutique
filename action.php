<?php
$url = "";
include 'src/Base.php';
$error = [];
$return = [];
if (in_array($_POST['type'], ['inscription', 'connexion'])) {
    $account = new Base\register_connexion();
    if ($_POST['type'] == "inscription") {
        $url = "connexion.php";
        $error = $account->register();
        $return = [$url, $error];
    }

    if ($_POST['type'] == "connexion") {
        $url = "index.php";
        $error = $account->connexion();
        $return = [$url, $error];
    }
}
if ($_POST['type'] == "modif_password") {
    $profil = new Base\profil_utilisateurs;
    $url = "profil_password.php";
    $error = $profil->register();
    $return = [$url, $error];
}

if ($_POST['type'] == "change_profil_email") {
    $profil = new Base\profil_utilisateurs;
    $url = "profil_user.php";
    $error = $profil->change();
    $return = [$url, $error];

}
if ($_POST['type'] == "addadress") {
    $profil = new Base\profil_utilisateurs;
    $url = "profil_adresse.php";
    $error = $profil->addAdress();
    $return = [$url, $error];

}
if ($_POST['type'] == 'editAddress') {
    $profil = new Base\profil_utilisateurs;
    $url = "profil_adresse.php";
    $error = $profil->editAddress();
    $return = [$url, $error];
}
if ($_POST['type'] == "deleteAddress") {
    $profil = new Base\profil_utilisateurs;
    $url = "profil_adresse.php";
    $error = $profil->deleteAdress();
    $return = ['url' => $url, 'return' => $error];
}
if ($_POST['type'] == "panierAdd") {
    $product = new Base\product__cat();
    $url = "cart.php";
    $error = $product->Cart();
    $return = [$url, $error];
}
if ($_POST['type'] == "deleteProductcart") {
    $product = new Base\actionPanier();
    $url = "cart.php";
    $error = $product->deleteProductcart();
    $return = ['url' => $url, 'return' => $error];
}
if ($_POST['type'] == "checkprice") {
    $coupon = new Base\discount();
    $url = "paiement.php";
    $error = $coupon->addFacturation();
    $return = ['url' => $url, 'return' => $error];
}
if ($_POST['type'] == "checkcoupon") {
    $coupon = new Base\discount();
    $url = "paiement.php";
    $error = $coupon->getNewPrice();
    $return = ['url' => $url, 'return' => $error];
}
echo json_encode($return);