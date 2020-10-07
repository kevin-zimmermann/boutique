<?php

use Base\Profil;
include 'src/Base.php';
$user = new Base\profil_utilisateurs();
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
                    <li><a href="inscription.php"><i class="fas fa-user"></i></a></li>
                    <li><a href=""> <i class="fas fa-cart-plus"></i></a></li>
                </ul>
                <?php if (isset($_SESSION['id'])) { ?>
                    <ul>
                        <div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle" type="button" data-toggle="dropdown"> <a href=""> <i class="fas fa-user"></i></a></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="moncompte.php">Mon compte</a>
                                <a class="dropdown-item" href="connexion.php">Déconnexion</a>
                                <a class="dropdown-item" href="#"></a>
                            </div>
                        </div>
                        <li><a href=""> <i class="fas fa-cart-plus"></i></a></li>
                    </ul>
                    <?php
                }
                ?>
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
                <?php
                if ($user->isAdmin() == true){
                    ?>
                    <li><a href="admin.php">
                            Admin
                        </a>
                    </li>
                <?php }  ?>
            </ul>
            <form class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-dark" type="submit">Search</button>
            </form>
        </div>

        <?php if ($user->getIsConnect()) { ?>Bonjour <?= $user->prenom ?></li>
        <?php } else {
            return false;
        }
        ?>
    </div>
</header>