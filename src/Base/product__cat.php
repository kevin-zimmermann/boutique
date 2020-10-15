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
    protected $extensionType = ['.png', '.jpeg', '.jpg'];

    public function addProduct()
    {
        $error = [];

        $cat = htmlentities($_POST['categorie']);
        $nproduit = htmlentities($_POST['nom_produit']);
        $description = htmlentities($_POST['description']);
        $taille = htmlentities($_POST['taille']);
        $prix = htmlentities($_POST['prix']);
        $quantite = htmlentities($_POST['quantite']);
        $checkLog = $this->checkLogo();
        $errors = [];
        if (empty ($cat || $nproduit || $description || $taille || $prix || $quantite)) {
            $error[] = "Il manque un quelque chose....";
        }
        if(!empty($checkLog['error']))
        {
            $errors[] = $checkLog['error'];
        }
        if (empty($errors)) {var_dump($_POST);
            $test = $this->query('INSERT INTO produit(image, categorie_id, nom_produit, description, taille, prix, quantite) VALUES(?,?,?,?,?,?,?) ', [
                '',
                $cat,
                $nproduit,
                $description,
                $taille,
                $prix,
                $quantite
            ]);
            var_dump($test);
            $this->setLogo();
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
        $product = $this->product;
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
        $cat = $_POST['categorie'];
        $nproduit = $_POST['nom_produit'];
        $description = $_POST['description'];
        $taille = $_POST['taille'];
        $prix = $_POST['prix'];
        $quantite = $_POST['quantite'];
        $product = $this->query('SELECT * FROM produit WHERE id = ?', [
            $productId,
        ])->fetch(\PDO::FETCH_ASSOC);
        $checkLog = $this->checkLogo();
        $errors = [];
        if(!empty($checkLog['error']))
        {
             $errors[] = $checkLog['error'];
        }
        if (!empty($product) && empty($errors)) {
            $this->query('UPDATE produit SET image = ?, categorie_id = ?, nom_produit = ?, description = ?, taille = ? , prix = ?, quantite = ?  WHERE id = ?', [
                '',
                $cat,
                $nproduit,
                $description,
                $taille,
                $prix,
                $quantite
            ]);
            $this->setLogo();
        }
        return [];
    }

    /**
     * @return array
     */
    public function checkLogo()
    {
        $type = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        $output = [
            'type' => $type
        ];
        if (!in_array("." . $type, $this->extensionType)) {
            $output['error'] = "Format d'image autorisé: " . implode(", ", $this->extensionType);
        }
        return $output;
    }


    public function setLogo()
    {
        $pathAvatar = 'data/product_img/';
        $name = $this->lastInsertId() . ".jpg";
        foreach (scandir($pathAvatar) as $avatar) {
            if (pathinfo($avatar, PATHINFO_FILENAME) == pathinfo($name, PATHINFO_FILENAME)) {
                $path = $pathAvatar . $avatar;
                unset($path);
            }
        }
        move_uploaded_file($_FILES["image"]["tmp_name"], $pathAvatar . $name);
    }
    public function getCategorie()
    {
        $response = $this->query('SELECT * FROM categorie');
        return $response->fetchAll(\PDO::FETCH_ASSOC);
    }



}