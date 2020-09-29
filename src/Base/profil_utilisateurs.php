<?php 
namespace Base;

use PDO;

class Profil extends DataBase {
protected $test = "";
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
      
    }
public function getUser()
{
    return $this->query('SELECT * FROM utilisateurs WHERE id = ?', [
        $_SESSION['id']
    ])->fetch(PDO::FETCH_ASSOC);
    //var_dump($user->tests);
}
public function __get($key)
{
    $user = $this->getUser();
    if(isset($user[$key]))
    {
        return $user[$key];
    }
    if(isset($this->{$key}))
    {
        return $this->{$key};
    }
    return null;
}
public function __set($key, $value)
{
    $this->{$key} = $value;
}
public function register( $password, $newpassword, $repeatnewpassword) 
{
    $error = [];
            $user = $this->getUser();
            if(!password_verify($password, $user['password']))
            {

            }

            if(empty($error)) {
                $password = password_hash($newpassword, PASSWORD_BCRYPT, ['cost' => 15]);
                
                $this->query("UPDATE utilisateurs SET password= ? WHERE id= ?", [
                    $password,
                    $_SESSION['id'],
                ]);
            }
            return $error;
        }


    public function change( $email, $nom, $prenom, $phone) {

        $user = $this->query("SELECT * FROM utilisateurs WHERE id = '".$_SESSION['id']."'", [
            $this->$_SESSION['id']
            ])->fetch(PDO::FETCH_ASSOC);
            var_dump($user);
        
        if (!empty($user)) {
        $error[] = "L'adresse email existe déjà !";
        } else {

        $this->query('UPDATE utilisateurs (nom, prenom, email, phone) VALUE(?, ?, ?, ?)', [
            $email,
            $nom,
            $prenom,
            $phone,

        ]);}
        return $error;
    }

}

