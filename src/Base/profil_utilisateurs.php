<?php 
namespace Base;

use PDO;

class profil_utilisateurs extends DataBase {
protected $test = "";
// protected $nom;
// protected $prenom;
// protected $email;
// protected $adresse;
// protected $code_postal;
// protected $ville;
// protected $phone;
// protected $password;
// protected $newpassword;
// protected $repeatnewpassword;
public function getUser()
{
    return $this->query('SELECT * FROM utilisateurs WHERE id = ?', [
        $_SESSION['id']
    ])->fetch(PDO::FETCH_ASSOC);
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

    }
?>