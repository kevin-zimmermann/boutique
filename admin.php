<?php

use Base\Profil;
include 'src/Base.php';
include 'header.php';
$user = new Base\profil_utilisateurs;
?>

<?php
if (!isset($_SESSION['id'])) {

} else {
    ?>
    <p>Bienvunue <?= $_SESSION['prenom'];
     
    }
    ?> </p>
