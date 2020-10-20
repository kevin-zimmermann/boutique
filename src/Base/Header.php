<?php


namespace Base;

use PDO;

class Header extends DataBase
{
    public function getCategories()
    {
        $response = $this->query('SELECT * FROM categorie');
        return $response->fetchAll(\PDO::FETCH_ASSOC);
    }
}