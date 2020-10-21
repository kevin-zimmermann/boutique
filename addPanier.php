<?php

include 'src/Base.php';

$base = new \Base\DataBase();
$product = new Base\product__cat();
$panier = new Base\actionPanier();
$product = $product->setProduct();

if (isset($_GET['id'])) {
    $product = $base->requete('SELECT produit_id FROM produit WHERE produit_id=produit_id', array( $_GET['produit_id']));
    if(empty($product)) {
        die ("ce produit n'existe pas");
    }
    $panier-> add($product[0]->produit_id);
    die ("Le produit a bien été ajouté à votre panier ");
} else {
    die ("Vous n'avez pas sélectionné de produit pour le panier");
}
var_dump($_GET);
var_dump($product);


