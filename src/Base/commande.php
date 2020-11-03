<?php

namespace Base;
use PDO;


class commande extends DataBase
{
    public function getCommandeId(){
        $this->query('');

    }

    public function getCommande() {
        return $this->query('SELECT c.*, p.* FROM commande_produit as c, produit as p WHERE c.produit_id = p.produit_id AND commande_id = ?',[
            $_GET['commande_id']
        ])->fetchAll(PDO::FETCH_ASSOC);
    }



}