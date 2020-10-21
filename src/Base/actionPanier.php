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
}