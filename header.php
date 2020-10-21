<?php

use Base\Profil;

include 'src/Base.php';
$user = new Base\profil_utilisateurs();
$header = new Base\Header();
?>

<header>
    <div class="big-header">
        <div class="inline-nav-img">
            <nav class="big-nav">
                <div class="bond-title">
                    <h1 class="title">FOO2F <a href="index"></a>
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
                    <li class="center">
                        <?php if ($user->getIsConnect()) {
                        ?>Bonjour <?= $user->prenom ?>
                    <?php } else {
                        return false;
                    }
                    ?>
                    </li>
                    <li class="dropdown-marge dropdown">
                        <button class="btn btn-dark dropdown-toggle" type="button" data-toggle="dropdown"><a href=""> <i
                                        class="fas fa-user"></i></a></button>
                        <div class="dropdown-menu">
                            <?php
                            if ($user->isAdmin()) {
                                ?>
                                <a class="dropdown-item" href="admin.php">Panel admin</a>
                            <?php } ?>
                            <a class="dropdown-item" href="profil.php">Mon profil</a>
                            <a class="dropdown-item" href="disconnect.php">Déconnexion</a>
                            <a class="dropdown-item" href="#"></a>
                        </div>
                    </li>
                    <li class="cart-plus">
                        <a href="panier.php">
                            <i class="fas fa-cart-plus"></i>
                        </a>
                    </li>
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
            <li class="dropdown">
                <a data-toggle="dropdown" href="boutique.php">Boutique</a>
                <div class="dropdown-menu">
                    <?php foreach ($header->getCategories() as $categorie) { ?>
                        <div class="dropdown-item">
                            <a href="boutique.php"><?= $categorie['nom_categorie'] ?></a>
                        </div>
                    <?php } ?>
                </div>
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