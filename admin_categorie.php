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
class categorie extends DataBase
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

}