<footer style="width: 100%">
    <div class="list-header">
        <ul>
            <li><a class="lien" href="index.php">Accueil</a></li>
            <li><a class="lien" href="boutique.php">Boutique</a></li>
            <?php if (!isset($_SESSION['id'])) { ?>
                <li><a class="lien" href="inscription.php">Inscription</a></li>
                <li><a class="lien" href="connexion.php">Connexion</a></li>
            <?php } else { ?>
                <li><a class="lien" href="disconnect.php">Déconnexion</a></li>
            <?php } ?>
            <div class="social">
                <li><a class="lien" href=""> <i class="fab fa-instagram"></i></a></li>
                <li><a class="lien" href=""> <i class="fab fa-facebook"></i></a></li>
                <li><a class="lien" href=""> <i class="fab fa-twitter"></i></a></li>
        </ul>
    </div>
</footer>