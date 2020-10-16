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
    protected $currentEntity = 'product';
    protected $category = [];
    public function addProduct()
    {
        $error = [];

        $cat = htmlentities($_POST['categorie']);
        $nproduit = htmlentities($_POST['nom_produit']);
        $description = htmlentities($_POST['description']);
        $prix = htmlentities($_POST['prix']);
        if (empty($_FILES)) {
            $error[] = "Il manque un quelque chose....";
        } else {
            $checkLog = $this->checkLogo();
            if (!empty($checkLog['error'])) {
                $error[] = $checkLog['error'];
            }
        }
        if (empty ($cat || $nproduit || $description || $prix)) {
            $error[] = "Il manque un quelque chose....";
        }
        if (empty($error)) {
            $test = $this->query('INSERT INTO produit(image, categorie_id, nom_produit, description, prix) VALUES(?,?,?,?,?) ', [
                '',
                $cat,
                $nproduit,
                $description,
                $prix,
            ]);
            $productId = $this->lastInsertId();
            $arrayTaille = [
                's',
                'm',
                'l',
                'xl'
            ];
            $this->setLogo();
            foreach ($arrayTaille as $taille) {
                if (empty($_POST[$taille])) {
                    $currentTaille = 0;
                } else {
                    $currentTaille = $_POST[$taille];
                }
                $this->query('INSERT INTO stock(taille, produit_id, stock) VALUES(?,?,?) ', [
                    $taille,
                    $productId,
                    $currentTaille,
                ]);
            }
        }
        return $error;


    }

    public function deleteProduct()
    {
        $productId = $_POST['product_id'];
        $product = $this->query('SELECT * FROM produit WHERE produit_id = ?', [
            $productId,
        ])->fetch(\PDO::FETCH_ASSOC);
        if (!empty($product)) {
            $this->query('DELETE FROM produit WHERE produit_id = ?', [
                $productId
            ]);
            $path = 'data/product_img/' . $productId . '.jpg';
            if (file_exists($path)) {
                unlink($path);
            }
            $this->query('DELETE FROM stock WHERE produit_id = ?', [
                $productId
            ]);


        }

        return $productId;
    }
    public function setCatgeorie()
    {
        $this->currentEntity = 'category';
        $this->category = $this->query('SELECT * FROM categorie WHERE categorie_id = ?', [$_GET['categorie_id']])->fetch(\PDO::FETCH_ASSOC);
        return $this;
    }
    public function deleteCategorie()
    {
        $categorieId = $_POST['categorie_id'];
        $this->query('DELETE FROM categorie WHERE categorie_id = ?', [
            $categorieId
        ]);

        return $categorieId;

    }
    public function getProducts()
    {
        $response = $this->query('SELECT * FROM produit');
        return $response->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function setProduct()
    {
        $this->product = $this->query('SELECT * FROM produit WHERE produit_id = ?', [$_GET['produit_id']])->fetch(\PDO::FETCH_ASSOC);
        return $this;
    }
    public function getSizes()
    {
        return $this->query('SELECT * FROM stock WHERE produit_id = ? ORDER BY taille', [$_GET['produit_id']])->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function addCategorie()
    {
        $error = [];
        if ($_POST['type'] == 'addcategorie') {
            $nom_categorie = htmlentities($_POST['nom_categorie']);
            $this->query('INSERT INTO categorie (nom_categorie) VALUE(?)', [
                $nom_categorie
            ]);
            $categorie = $this->query('SELECT * FROM categorie WHERE categorie_id = ?', [
                $this->lastInsertId()
            ])->fetch(\PDO::FETCH_ASSOC);
            $categorie = [
                'id' => $categorie['categorie_id'],
                'name' => $categorie['nom_categorie']
            ];

        } else {
            $error[] = "Il manque un quelque chose....";
            $categorie = null;
        }
        return [
            'value' => $categorie,
            'error' => $error
        ];
    }

    public function __get($key)
    {
        $newValue = $this->newValue;
        if (!empty($newValue[$key])) {
            return $newValue[$key];
        }

        if ($this->currentEntity == 'product') {
            $entity = $this->product;
        } else {
            $entity = $this->category;
        }

        return $this->getValue($entity, $key);
    }

    protected function getValue($entity, $key)
    {
        if (!empty($entity[$key])) {
            return $entity[$key];
        }
        return '';
    }

    public function __set($key, $value)
    {
        $this->newValue[$key] = $value;
    }

    public function updateProduct()
    {
        $productId = $_GET['produit_id'];
        $cat = $_POST['categorie'];
        $nproduit = $_POST['nom_produit'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $product = $this->query('SELECT * FROM produit WHERE produit_id = ?', [
            $productId,
        ])->fetch(\PDO::FETCH_ASSOC);
        if (!empty($_FILES)){
            $checkLog = $this->checkLogo();
            $errors = [];
            if (!empty($checkLog['error'])) {
                $errors[] = $checkLog['error'];
            }
        }
        if (!empty($product) && empty($errors)) {
            $this->query('UPDATE produit SET image = ?, categorie_id = ?, nom_produit = ?, description = ?,  prix = ?  WHERE produit_id = ?', [
                '',
                $cat,
                $nproduit,
                $description,
                $prix,
                $_GET['produit_id']
            ]);
            foreach ($this->getSizes() as $size)
            {
                $currentSize = $_POST[$size['taille']];
                $this->query('UPDATE stock set stock = ? WHERE produit_id = ? AND taille = ? ', [
                    $currentSize,
                    $productId,
                    $size['taille']
                ]);
            }
            if (!empty($_FILES)){
            $this->setLogo();
            }
        }
        return [];
    }
    public function updateCategory()
    {
        $NameCategory = $_POST['nom_categorie'];
        $this->query('UPDATE categorie SET nom_categorie = ? WHERE categorie_id = ?', [
            $NameCategory,
            $_GET['categorie_id']
        ]);
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