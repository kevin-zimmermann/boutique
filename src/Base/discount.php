<?php


namespace Base;

use PDO;

class discount extends actionPanier
{
    public function getReduc()
    {
        $reduc = $this->query('SELECT * FROM discount');
        return $reduc->fetchAll();
    }

    public function deleteReduc()
    {
        $reducId = $_POST['discount_id'];
        $reduc = $this->query('DELETE FROM discount WHERE discount_id = ?', [
            $reducId,
        ]);
        return $reducId;
    }

    public function addReduc()
    {
        $error = [];
        $coupon = [];
        $nom = $_POST['nom'];
        $time = $_POST['valid_time'];
        $datetime = new \DateTime($time);
        $valeur = (int)$_POST['valeur'];
        $type = $_POST['format'];
        if ($valeur > 100 && $type == "pourcent") {
            $error[] = "La réduction ne peut être supérieur à 100%";
        } else {

            $this->query('INSERT INTO discount (`nom`,`valid_time`,`valeur`,`type`) VALUES (?,?,?,?) ', [
                $nom,
                $datetime->getTimestamp(),
                $valeur,
                $type
            ]);
            $bla = $this->lastInsertId();
            $coupon = $this->query('SELECT * FROM discount WHERE discount_id = ? ', [
                $bla,
            ])->fetch(PDO::FETCH_ASSOC);
        }
        return [
            'error' => $error,
            'value' => $coupon,
        ];


    }

    public function addFacturation()
    {
        $id = $_SESSION['id'];
        $prix_tot = $this->getPrice()[0];
        $testId = $this->query('SELECT * FROM facturation WHERE user_id = ?', [
            $id
        ])->fetch();
        if (empty($testId)) {
            $this->query('INSERT INTO facturation (coupon_id, prix_tot, prix_reduc, user_id) VALUES (?,?,?,?)', [
                0,
                $prix_tot,
                $prix_tot,
                $id,
            ]);
        } else {
            $this->query('UPDATE facturation SET prix_tot = ?, coupon_id = ?, prix_reduc = ? WHERE user_id = ?', [
                $prix_tot,
                0,
                $prix_tot,
                $id
            ]);
        }
    }

    public function getNewPrice()
    {
        $oldprice = $this->getPrice()[0];
        $id = $_SESSION['id'];
        $error = [];
        $coupon = $_POST['coupon'];
        $nomc = $this->query('SELECT * FROM discount WHERE nom = ?', [
            $coupon
        ])->fetch();
        $newprice = $oldprice;
        if ($nomc['valid_time'] < time()) {
            $error[] = "Le coupon est invalide !";
        }
        if (!empty($coupon) && empty($error)) {
            if ($nomc['type'] == 'euro') {
                if ($nomc['valeur'] > $oldprice) {
                    $error[] = 'Impossible car la réduction est trop grande';
                } else {
                    $newprice = $oldprice - $nomc['valeur'];
                    $this->query('UPDATE facturation SET coupon_id = ? , prix_reduc = ? WHERE user_id = ?', [
                        $nomc['discount_id'],
                        $newprice,
                        $id
                    ]);
                }
                return [round($newprice, 2), $error];

            } elseif ($nomc['type'] == 'pourcent') {
                $newprice = $oldprice * (1 - ($nomc['valeur'] / 100));
                $this->query('UPDATE facturation SET coupon_id = ? , prix_reduc = ? WHERE user_id = ?', [
                    $nomc['discount_id'],
                    $newprice,
                    $id
                ]);
            }
            return [round($newprice, 2), $error];

        } else {
            return [$oldprice, $error];

        }

    }


}