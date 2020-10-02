<?php

use Base\Profil;

session_start();
 include 'src/Base/DataBase.php';
 include 'src/Base/profil_utilisateurs.php';

if (!isset($_SESSION['id'])) {
    ?><a href="inscription.php">inscription</a>
    <a href="connexion.php">connexion</a>
    <?php
} else {
    ?>
    <p>Bonjour <?= $_SESSION['prenom'] ?> </p>

<?php
if (isset($_GET['type']) and $_GET['type'] == 'admin') {
    if (isset($_GET['confirme']) and !empty($_GET['confirme'])) {
        $confirme = (int)$_GET['confirme'];
        $req = $bdd->prepare('UPDATE membres SET confirme = 1 WHERE id = ?');
        $req->execute(array($confirme));
    }
    if (isset($_GET['supprime']) and !empty($_GET['supprime'])) {
        $supprime = (int)$_GET['supprime'];
        $req = $bdd->prepare('DELETE FROM membres WHERE id = ?');
        $req->execute(array($supprime));
    }
}
}
?>