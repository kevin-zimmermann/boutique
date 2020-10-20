<?php

include 'src/Base.php';

$base = new \Base\DataBase();
$product = new Base\product__cat();
$panier = new Base\actionPanier();
$product = $product->setProduct();

if (isset($_GET['id'])) {
    $product = $DataBase->requete('SELECT produit_id FROM produit WHERE produit_id = ?', array('produit_id' => $_GET['produit_id']));
    if(empty($product)) {
        die ("ce produit n'existe pas");
    }
    $panier-> add($product[0]->produit_id);
    die ("Le produit a bien été ajouté a votre panier ");
} else {
    die ("Vous n'avez pas sélectionné de produit");
}
var_dump($_GET);
var_dump($product);


