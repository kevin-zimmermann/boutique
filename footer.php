<footer>
    <?php if (!isset($_SESSION['id'])) { ?>
        <a href="inscription.php">Inscription</a>
        <a href="connexion.php">Connexion</a>
    <?php } else { ?>
        <a href="disconnect.php">Déconnexion</a>
    <?php } ?>
</footer>