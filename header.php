<?php

use Base\Profil;

session_start();
include 'src/Base/DataBase.php';
include 'src/Base/profil_utilisateurs.php';
?>

<head>
    <link rel="stylesheet" href="styles/css/headerfooter.css">
</head>
<header>
    <div class="big-header">
        <div class="inline-nav-img">
            <nav class="big-nav">
                <h1 class="title">FOO2F<i class="far fa-futbol"></i>OT</h1>
                <!--- <img src="https://upload.wikimedia.org/wikipedia/fr/thumb/4/43/Logo_%C3%89quipe_France_Football_2018.svg/679px-Logo_%C3%89quipe_France_Football_2018.svg.png"
                     width="auto" height="100px" alt="logo"> --->
                <ul>
                    <li><a href=""> <i class="fas fa-user"></i></a></li>
                    <li><a href=""> <i class="fas fa-cart-plus"></i></a></li>
                </ul>
            </nav>
        </div>
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
                <li> <?php if (isset($_SESSION['id'])) { ?>
                        Bonjour <?= $_SESSION['prenom'] ?></li>
            <?php } else { ?>
                <li><a href="connexion.php">Connexion</a></li>
                <li><a href="inscription.php">Inscription</a></li>
            <?php } ?>
            </li>
            </ul>
            <form class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-dark" type="submit">Search</button>
            </form>
        </div>
</header>