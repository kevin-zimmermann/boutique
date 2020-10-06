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
class profil_utilisateurs extends DataBase
{
    protected $user = [];
    protected $id = NULL;
    protected $nom = NULL;
    protected $prenom = NULL;
    protected $email = NULL;
    protected $adresse;
    protected $code_postal;
    protected $ville;
    protected $phone;
    protected $password;
    protected $newpassword;
    protected $repeatnewpassword;

    function __construct()
    {
        parent::__construct();
        $this->user = $this->getUser();
    }

    public function getUser()
    {
        if (isset($_SESSION['id'])) {
            return $this->query('SELECT * FROM utilisateurs WHERE id = ?', [
                $_SESSION['id']
            ])->fetch(PDO::FETCH_ASSOC);
        }
        return [];
        //var_dump($user->tests);
    }

    public function __get($key)
    {
        return $this->getValue($key);
    }

    public function getValue($key)
    {
        $user = $this->user;
        if (isset($user[$key])) {
            return $user[$key];
        }
        if (isset($this->{$key})) {
            return $this->{$key};
        }
        return null;
    }

    public function getIsConnect()
    {
        if (empty($this->user)) {
            return false;
        }
        return true;
    }

    public function __set($key, $value)
    {
        $this->{$key} = $value;
    }

    public function register($password, $newpassword, $repeatnewpassword)
    {
        $error = [];
        $user = $this->getUser();
        if (!password_verify($password, $user['password'])) {


        }

        if (empty($error)) {
            $password = password_hash($newpassword, PASSWORD_BCRYPT, ['cost' => 15]);

            $this->query("UPDATE utilisateurs SET password= ? WHERE id= ?", [
                $password,
                $_SESSION['id'],
            ]);
        }
        return $error;
    }


    public function change()
    {
        $email = $_POST['email'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $phone = $_POST['telephone'];
        $testEmail = $this->query("SELECT * FROM utilisateurs WHERE email = ? AND email != ?", [
            $_POST['email'],
            $this->email
        ])->fetch(PDO::FETCH_ASSOC);
        var_dump($_SESSION);
        $error = [];
        if (!empty($testEmail)) {
            $error[] = "L'adresse email existe déjà !";
        } else {

            $this->query('UPDATE utilisateurs set nom = ? , prenom = ? , email = ?, telephone = ? where id = ?', [
                $nom,
                $prenom,
                $email,
                $phone,
                $this->getValue('id')
            ]);
        }
        return $error;
    }

    public function isAdmin()
    {
        if (isset($_SESSION)) {
            $isadmin = $this->query('SELECT admin FROM utilisateurs WHERE id = ?', [
                $_SESSION['id'],
            ])->fetch(PDO::FETCH_ASSOC);
            if (!empty($isadmin['admin']) && $isadmin['admin'] == 1) {
                return true;
            } else {
                return false;
            }
        }
    }
}

