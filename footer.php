<footer>
<div class="list-header">
            <ul>
                <li><a href="">
                        Accueil
                    </a>
                </li>
                <li><a href="">
                        Boutique
                    </a>
                </li>
                <li><a href="">
                       Calendrier
                    </a>
                </li>
    <?php if (!isset($_SESSION['id'])) { ?>
        <a href="inscription.php">Inscription</a>
        <a href="connexion.php">Connexion</a>
    <?php } else { ?>
        <a href="disconnect.php">Déconnexion</a>
    <?php } ?>
    <div class="social">
    <li><a href=""> <i class="fab fa-instagram"></i></a></li>
    <li><a href=""> <i class="fab fa-facebook"></i></a></li>
    <li><a href=""> <i class="fab fa-twitter"></i></a></li>
</div>
</footer>