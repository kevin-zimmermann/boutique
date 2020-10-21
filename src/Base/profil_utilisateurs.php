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
 *
 * @property int adresse_id
 * @property string nom
 * @property string prenom
 * @property string adresse
 * @property string code_postal
 * @property string ville
 * @property string telephone
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
    protected $currentEntity = 'user';
    protected $address;
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
        if ($this->currentEntity == 'user') {
            $entity = $this->user;
        } else {
            $entity = $this->address;
        }
        return $this->getValue($key, $entity);
    }

    public function getValue($key,$entity)
    {
        if (!empty($entity[$key])) {
            return $entity[$key];
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
        $error = [];
        if (!empty($testEmail)) {
            $error[] = "L'adresse email existe déjà !";
        }
        if (empty($prenom|| $nom || $phone|| $email)) {
            $error[] = "Euh je crois qu'il manque quelque chose !";
        }
        else {

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
        if(empty($_SESSION['id']))
        {
            return false;
        }
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
    public function getAdress()
    {
        if (isset($_SESSION['id'])) {
            return $this->query('SELECT * FROM adresse WHERE utilisateur_id = ?', [
                $_SESSION['id']
            ])->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }

    public function setAdress()
    {
        $this->address = $this->query('SELECT * FROM adresse WHERE adresse_id = ?', [$_GET['adresse_id']])->fetch(\PDO::FETCH_ASSOC);
        $this->currentEntity = 'address';
        return $this;
    }
    public function deleteAdress()
    {
        $adressId = $_POST['adresse_id'];
        $this->query('DELETE FROM adresse WHERE adresse_id = ?', [
            $adressId
        ]);

        return $adressId;

    }
    public function addAdress(){
        $error = [];
        $id = $_SESSION['id'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $postal = $_POST['postal'];
        $ville = $_POST['ville'];
        $telephone = $_POST['telephone'];

        $this->query('INSERT INTO adresse(`utilisateur_id`, `nom`, `prenom`, `adresse`, `code_postal`, `ville`, `telephone`) VALUE(?,?,?,?,?,?,?) ', [
            $id,
            $nom,
            $prenom,
            $adresse,
            $postal,
            $ville,
            $telephone,

        ]);
        $addressId = $this->query('SELECT * FROM adresse WHERE adresse_id = ?', [
            $this->lastInsertId()
        ])->fetch(\PDO::FETCH_ASSOC);
        return [
            'value' => $addressId,
            'error' => $error
        ];
    }
    public function editAddres()
    {
        $addressId = $_GET['adresse_id'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $postal = $_POST['postal'];
        $ville = $_POST['ville'];
        $telephone = $_POST['telephone'];
        $this->query('UPDATE adresse SET nom = ?, prenom = ?, adresse = ?, code_postal = ?, ville = ?, telephone = ?  WHERE adresse_id = ?', [
            $nom,
            $prenom,
            $adresse,
            $postal,
            $ville,
            $telephone,
            $addressId
        ]);
        return [];
    }
}

