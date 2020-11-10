<?php

namespace Base;
use PDO;


class commande extends DataBase
{

    public function getCommande() {
        return $this->query('SELECT c.*, p.* FROM commande_produit as c, produit as p WHERE c.produit_id = p.produit_id AND commande_id = ?',[
            $_GET['commande_id']
        ])->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllCommande()
    {
        return $this->query('SELECT c.*, d.*, u.* 
                                    FROM commandes as c, adresse as d, utilisateurs as u 
                                    WHERE  d.adresse_id = c.adresse_id AND c.utilisateur_id = u.id'
        )->fetchAll(PDO::FETCH_ASSOC);
    }
    public function priceCommande(){
        return $this->query('SELECT prix FROM commandes WHERE commande_id = ?',[
            $_GET['commande_id']
        ])->fetchAll(PDO::FETCH_ASSOC);
    }



}