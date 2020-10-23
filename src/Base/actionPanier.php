<?php

namespace Base;

use PDO;


class actionPanier extends DataBase
{
    public function getPanier()
    {
        if (isset ($_SESSION['id'])) {
            return $this->query ('SELECT panier.*, product.* FROM panier, produit as product WHERE user_id = ? 
                            AND panier.product_id = product.produit_id', [
                $_SESSION['id']
            ] )->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function setSize($size, $productId)
    {
        return $this->query('SELECT * FROM stock WHERE produit_id = ? AND taille = ? ', [
            $productId,
            $size
        ])->fetch(\PDO::FETCH_OBJ);
    }
    public function updateSize()
    {
        $size = $_POST['size'];
        $productId = $_POST['productId'];
        $value = $_POST['value'];
        $this->query('UPDATE panier SET quantity = ? WHERE product_id = ? AND size = ?', [
            $value,
            $productId,
            $size,
        ]);
    }
    public function deleteProductcart(){
        $panierId = $_POST['panier_id'];
        $this->query('DELETE FROM panier WHERE panier_id = ?',[
            $panierId
        ]);
        return $panierId;
    }
}