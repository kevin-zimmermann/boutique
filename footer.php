<footer style="width: 100%">
    <div class="list-header">
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="boutique.php">Boutique</a></li>
            <?php if (!isset($_SESSION['id'])) { ?>
                <li><a href="inscription.php">Inscription</a></li>
                <li><a href="connexion.php">Connexion</a></li>
            <?php } else { ?>
                <li><a href="disconnect.php">Déconnexion</a></li>
            <?php } ?>
            <div class="social">
                <li><a href=""> <i class="fab fa-instagram"></i></a></li>
                <li><a href=""> <i class="fab fa-facebook"></i></a></li>
                <li><a href=""> <i class="fab fa-twitter"></i></a></li>
        </ul>
    </div>
</footer>
<script src="script.js"></script>