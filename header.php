<?php

use Base\Profil;

include 'src/Base.php';
$user = new Base\profil_utilisateurs();
?>

<header>
    <div class="big-header">
        <div class="inline-nav-img">
            <nav class="big-nav">
                <div class="bond-title">
                    <h1 class="title">FOO2F
                        <span class="ballon-inner">
                            <i onMouseOver="" class=" bond far fa-futbol"></i>
                            <span class="ombre-other">
                                <span class="ombre"></span></span>
                            <span class="ballon"></span>
                        </span>OT
                    </h1>
                </div>
                <?php if (isset($_SESSION['id'])) { ?>
                <ul>
                    <div class="center">
                        <?php if ($user->getIsConnect()) {
                            ?>Bonjour <?= $user->prenom ?></li>
                        <?php } else {
                            return false;
                        }
                        ?>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle" type="button" data-toggle="dropdown"><a href=""> <i
                                        class="fas fa-user"></i></a></button>
                        <div class="dropdown-menu">
                            <?php if ($user->isAdmin()) { ?>
                                <a class="dropdown-item" href="admin.php">Admin</a>
                            <?php } ?>
                            <a class="dropdown-item" href="admin.php">Mon compte</a>
                            <a class="dropdown-item" href="disconnect.php">Déconnexion</a>
                            <a class="dropdown-item" href="#"></a>
                        </div>
                    </div>
                    <div class="cart-plus">
                        <li><a href="panier.php"> <i class="fas fa-cart-plus"></i></a></li>
                </ul>
        </div>
        </nav>
        <?php
        }
        ?>
        </nav>
    </div>
    <div class="list-header">
        <ul>
            <li><a href="index.php">
                    Accueil
                </a>
            </li>
            <li><a href="boutique.php">
                    Boutique
                </a>
            </li>
            <li><a href="calendrier.php">
                    Calendrier
                </a>
            </li>

        </ul>
        <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-dark" type="submit">Search</button>
        </form>
    </div>
    </div>
</header>