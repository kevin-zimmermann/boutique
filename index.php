<?php

use Base\Profil;

session_start();
 include 'src/Base/DataBase.php';
 include 'src/Base/profil_utilisateurs.php';

var_dump(new Profil());

if (!isset($_SESSION['id'])) {
    ?><a href="inscription.php">inscription</a>
    <a href="connexion.php">connexion</a>
    <?php
} else {
    ?>
    <p>Bonjour <?= $_SESSION['prenom'] ?> </p>

<?php
}
?>