<?php

use Base\Profil;

include 'src/Base.php';
$user = new Base\profil_utilisateurs();
$header = new Base\Header();
$product = new Base\product__cat();
$panier = new Base\actionPanier();
?>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<header>
    <div class="big-header">
        <div class="no-responsive-header">
            <div class="inline-nav-img">
                <nav class="big-nav">
                    <div class="bond-title"><a href="index.php">
                            <h1 class="title">FOO2F
                                <span class="ballon-inner">
                            <i onMouseOver="" class=" bond far fa-futbol"></i>
                            <span class="ombre-other">
                                <span class="ombre"></span></span>
                            <span class="ballon"></span>
                        </span>OT
                            </h1>
                        </a>

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
                            <button class="btn btn-dark dropdown-toggle" type="button" data-toggle="dropdown"><a
                                        href=""> <i
                                            class="fas fa-user"></i></a></button>
                            <div class="dropdown-menu">
                                <?php
                                if ($user->isAdmin()) {
                                    ?>
                                    <a class="dropdown-item" href="admin.php">Panel admin</a>
                                <?php } ?>
                                <a class="dropdown-item" href="profil.php">Mon profil</a>
                                <a class="dropdown-item" href="disconnect.php">Déconnexion</a>
                            </div>
                        </li>
                        <li class="cart-plus">
                            <a href="cart.php">
                                <i class="fas fa-cart-plus"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <?php
            }
            ?>
        </div>
        <div class="list-header">
            <ul>
                <li><a href="index.php">
                        Accueil
                    </a>
                </li>
                <li class="dropdown">
                    <a data-toggle="dropdown" href="boutique_all.php">Boutique</a>
                    <div class="dropdown-menu">
                        <?php foreach ($header->getCategories() as $categorie) { ?>
                            <div class="dropdown-item">
                                <a href="boutique.php?category_id=<?= $categorie['categorie_id'] ?>"><?= $categorie['nom_categorie'] ?></a>
                            </div>
                        <?php } ?>
                    </div>
                </li>
            </ul>
            <form class="form-inline search-box-content">
                <input class="form-control mr-sm-2 on-input-search" type="text" placeholder="Search"
                       aria-label="Search">
                <button class="btn btn-dark" type="submit">Search</button>
            </form>
        </div>
    </div>

    <div class="topnav">
        <a href="index.php" class="active fontlogo">FOO2FOOT</a>
        <div id="myLinks">
            <h5 class="text-white h4"><a href="index.php">Accueil</a></h5>
            <h5 class="text-white h4"><a href="boutique_all.php">Boutique</a></h5>
            <?php if ($user->getIsConnect()) {
                ?>
                <h5 class="text-white h4">
                    <a href="cart.php">
                        Panier
                    </a>
                    </a></h5>
                <h5 class="text-white h4">
                    <a href="profil.php">
                        Profil
                    </a>
                    </a></h5>
                <h5 class="text-white h4">
                    <a href="disconnect.php">Déconnexion</a>
                    </a></h5>
            <?php } ?>
        </div>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>

</header>
<script>
    function renderHtmlSearch(value) {
        let html = '<div class="search-content">';
        html += '<div class="search-cell">';
        html += '<img src="data/product_img/' + value.produit_id + '.jpg" >';
        html += '</div>';
        html += '<div class="name-product">';
        html += '<a href="product.php?produit_id=' + value.produit_id + '">'
        html += value.nom_produit;
        html += '</a>'
        html += '</div>'
        return html + '</div>'
    }

    $('.on-input-search').on('input', function (e) {
        e.preventDefault();
        let value = $(this).val();
        let offset = $(this).offset();
        console.log('dd');
        $.ajax({
            url: 'search.php',
            method: 'POST',
            dataType: 'json',
            data: {
                q: value
            },
            success: (data) => {
                let html = '';
                data.forEach((value) => {
                    html += renderHtmlSearch(value);
                })
                if ($('.search-block').length === 0) {
                    let divSearch = $('<div></div>');
                    divSearch.addClass('search-block');
                    divSearch.html(html);
                    $('body').append(divSearch);
                    divSearch.css('display', 'none')
                    divSearch.stop(true, true).slideDown();

                    divSearch.css('top', offset.top + 40).css('left', 10)
                } else {
                    let divSearch = $('.search-block');
                    divSearch.stop(true, true).slideDown();
                    divSearch.html(html);
                }
            },
            error: (error) => {
                console.log(error.responseText)
            }
        });
    })
    $('body').click(function (e) {
        let div = $(this).find('.on-input-search');
        let div2 = $(this).find('.search-block');
        if (div2.length) {
            if ((!$(e.target).is(div) && !$.contains(div[0], e.target)) && (!$(e.target).is(div2) && !$.contains(div2[0], e.target))) {
                div2.stop(true, true).slideUp();
            }
        }
    })
</script>
<script>
    function myFunction() {
        var x = document.getElementById("myLinks");
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }

</script>