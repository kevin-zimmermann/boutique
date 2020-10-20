<?php

namespace Base;

use MongoDB\Driver\Session;
use PDO;


class actionPanier extends DataBase
{
public function Panier()
{
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array();
    }
}
public function add($product_id) {
    $_SESSION['panier'][$product_id] = 1;

}
}