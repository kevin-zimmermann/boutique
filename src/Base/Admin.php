<?php

namespace Base;


class Admin extends DataBase
{
    protected $user = '';
    protected $newValue = [];
    public function deleteUser()
    {
        $userId = $_POST['user_id'];
        $user = $this->query('SELECT * FROM utilisateurs WHERE id = ? AND id = ?', [
            $_SESSION['id'],
            $userId
        ])->fetch(\PDO::FETCH_ASSOC);
        if(empty($user))
        {
            $this->query('DELETE FROM utilisateurs WHERE id = ?', [
                $userId
            ]);
        }

        return $userId;
    }

/*    public function countUser()
    {
         $compte = $this->query('SELECT COUNT (id) FROM utilisateurs');
         return $compte;
    }*/
    public function getUsers(){
        $response = $this->query('SELECT * FROM utilisateurs');
        return $response->fetchALl(\PDO::FETCH_ASSOC);
    }
    public function setUser()
    {
        $this->user = $this->query('SELECT * FROM utilisateurs WHERE id = ?', [$_GET['user_id']])->fetch(\PDO::FETCH_ASSOC);
        return $this;
    }
    public function __get($key)
    {
       $user = $this->user;
       $newValue = $this->newValue;
       if(!empty($newValue[$key]))
       {
           return $newValue[$key];
       }
       if(!empty($user[$key]))
       {
           return $user[$key];
       }
       return '';
    }
    public function __set($key, $value)
    {
        $this->newValue[$key] = $value;
    }
    public function updateUser()
    {
        $email = $_POST['email'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $tel = $_POST['telephone'];
        $admin = !empty($_POST['admin']) ? 1 : 0;
        $userId = $_GET['user_id'];
        $user = $this->query('SELECT * FROM utilisateurs WHERE id = ? AND id = ?', [
            $_SESSION['id'],
            $userId
        ])->fetch(\PDO::FETCH_ASSOC);
        if(!empty($user))
        {
            $this->query('UPDATE utilisateurs SET email = ?, nom = ?, prenom = ?, telephone = ?WHERE id = ?', [
                $email,
                $nom,
                $prenom,
                $tel,
                $userId
            ]);
        }
        else
        {
            $this->query('UPDATE utilisateurs SET email = ?, nom = ?, prenom = ?, telephone = ?, admin = ? WHERE id = ?', [
                $email,
                $nom,
                $prenom,
                $tel,
                $admin,
                $userId
            ]);
        }
        return [];
    }
}