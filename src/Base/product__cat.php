<?php

namespace Base;

use PDO;

/**
 * @proprety int id
 * @proprety string email
 * @proprety string nom
 * @proprety string telephone
 * @proprety string password
 * @proprety int cart_id
 * @proprety int admin
 */
class product__cat extends DataBase
{
    protected $product = '';
    protected $newValue = [];

    public function addProduct()
    {
        if ($_POST['type'] == 'addproduct') {
            $productId = htmlentities($_POST['product_id']);
            $image = htmlentities($_POST['image']);
            $cat = htmlentities($_POST['categorie']);
            $nproduit = htmlentities($_POST['nom_produit']);
            $description = htmlentities($_POST['description']);
            $taille = htmlentities($_POST['taille']);
            $prix = htmlentities($_POST['prix']);
            $quantite = htmlentities($_POST['quantite']);
            $error = [];
            $this->query('INSERT INTO produits (image, categorie, nom_produit, description , taille , prix , quantite ) VALUE(?, ?, ?, ?, ?,? ,? )', [
                $image,
                $cat,
                $nproduit,
                $description,
                $taille,
                $prix,
                $quantite

            ]);
        }
        if (empty ($cat || $image || $nproduit || $description || $taille || $prix || $quantite)) {
            $error[] = "Il manque un quelque chose....";
        } else {

        }
        return $error;


    }

    public function deleteProduct()
    {
        $productId = $_POST['product_id'];
        $product = $this->query('SELECT * FROM produit WHERE id = ?', [
            $productId,
        ])->fetch(\PDO::FETCH_ASSOC);
        if (empty($product)) {
            $this->query('DELETE FROM produit WHERE id = ?', [
                $productId
            ]);
        }

        return $productId;
    }

    public function getProducts()
    {
        $response = $this->query('SELECT * FROM produit');
        return $response->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function setProduct()
    {
        $this->product = $this->query('SELECT * FROM produit WHERE id = ?', [$_GET['product_id']])->fetch(\PDO::FETCH_ASSOC);
        return $this;
    }

    public function __get($key)
    {
        $product = $this->$product;
        $newValue = $this->newValue;
        if (!empty($newValue[$key])) {
            return $newValue[$key];
        }
        if (!empty($product[$key])) {
            return $product[$key];
        }
        return '';
    }

    public function __set($key, $value)
    {
        $this->newValue[$key] = $value;
    }

    public function updateProduct()
    {
        $productId = $_POST['product_id'];
        $image = $_POST['image'];
        $cat = $_POST['categorie'];
        $nproduit = $_POST['nom_produit'];
        $description = $_POST['description'];
        $taille = $_POST['taille'];
        $prix = $_POST['prix'];
        $quantite = $_POST['quantite'];
        $product = $this->query('SELECT * FROM produit WHERE id = ?', [
            $productId,
        ])->fetch(\PDO::FETCH_ASSOC);
        if (!empty($product)) {
            $this->query('UPDATE produit SET image = ?, categorie = ?, nom_produit = ?, description = ?, taille = ? , prix = ?, quantite = ?  WHERE id = ?', [
                $image,
                $cat,
                $nproduit,
                $description,
                $taille,
                $prix,
                $quantite
            ]);
        }
        return [];
    }

    /**
     * @return array
     */
    public function checkLogo()
    {
        $type = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
        $output = [
            'type' => $type
        ];
        if (!in_array("." . $type, $this->extensionType)) {
            $output['error'] = "Format d'image autorisé: " . implode(", ", $this->extensionType);
        }
        return $output;
    }

    /**
     * @param ProductImg $productImg
     * @throws \Exception
     */
    public function setLogo(ProductImg $productImg)
    {
        $pathAvatar = 'data/product_img/';
        $name = $productImg->product_img_id . ".jpg";
        foreach (scandir($pathAvatar) as $avatar) {
            if (pathinfo($avatar, PATHINFO_FILENAME) == pathinfo($name, PATHINFO_FILENAME)) {
                $path = $pathAvatar . $avatar;
                unset($path);
            }
        }
        move_uploaded_file($_FILES["file"]["tmp_name"], $pathAvatar . $name);
        $productImg->name = $_FILES["file"]["name"];
        $productImg->save();
    }

    public function addCategorie()
    {
        $error = [];
        if ($_POST['type'] == 'addcategorie') {
         $nom_categorie = htmlentities($_POST['nom_categorie']);
            $this->query('INSERT INTO categorie (nom_categorie,	produit_id) VALUE(?,?)', [
                $nom_categorie,
                0
            ]);
        }
        else{
            $error[] = "Il manque un quelque chose....";

        }
        return [];
        }

}