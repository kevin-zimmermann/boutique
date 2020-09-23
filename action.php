<?php
session_start();
$url = "";
include "DataBase.php";
$dataBase = new DataBase();
if ($_POST['type'] == "inscription") {
    $nom = htmlentities($_POST['nom']);
    $prenom = htmlentities($_POST['prenom']);
    $email = htmlentities($_POST['email']);
    $phone = htmlentities($_POST['phone']);
    $password = $_POST['password'];
    $error = [];
    $user = $dataBase->query('SELECT * FROM utilisateurs WHERE email = ?', [
        $email
    ])->fetch();
    if (!empty($user)) {
        $error[] = "L'adresse email existe déjà !";
    } else {
        $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 15]);
        $dataBase->query('INSERT INTO utilisateurs(nom, prenom, email, telephone, password, cart_id) VALUE(?, ?, ?, ?, ?, ?)', [
            $nom,
            $prenom,
            $email,
            $phone,
            $password,
            0
        ]);
    }


    $url = "connexion.php";
}

if ($_POST['type'] == "connexion") {
    $email = htmlentities($_POST['email']);
    $password = $_POST['password'];
    $error = [];
    if(empty($email))
    {
        $errors[] = 'Il faut mettre une adresse email' ;
    }
    if(empty($password))
    {
        $errors[] = 'il faut mettre un password';
    }
    $user = $dataBase->query('SELECT * FROM utilisateurs WHERE email = ? ', [
        $email
    ])->fetch();
    if(empty($user))
    {
        $errors[] = 'L\'utilisateur avec cette adresse email n\'existe pas';
    }
    if(!empty($user) && !password_verify($password, $user['password']))
    {
        $errors[] = 'Le mot de passe n\'est pas bon';
    }
    if(empty($errors))
    {
        $_SESSION['id'] = $user['id'];
        $_SESSION['prenom'] = $user['prenom'];
    }
    $url = "index.php";
}




echo json_encode([$url, $error]);


