<?php
session_start();
var_dump($_SESSION);
if (!isset($_SESSION['id'])) {
    ?><a href="inscription.php">inscription</a>
    <a href="connexion.php">connexion</a>
    <?php
} else {
    ?>
    <p>Bonjour <?= $_SESSION['prenom'] ?> </p>
<?php }
?>