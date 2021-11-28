<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Un petit verre de vino</title>

    <meta charset="utf-8">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, minimum-scale=0.5, initial-scale=1.0, user-scalable=yes">


    <meta name="description" content="Un petit verre de vino">

    <meta name="author" content="DFV">

    <!-- Logo Browser -->
    <link rel="shortcut icon" type="image/png" href="./assets/img/logo/logo-verre-white-circle.png">

    <!-- Iconnes importees  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles CSS  -->
    <link rel="stylesheet" href="css/normalize.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/base_h5bp.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/utilitaires.css" type="text/css" media="screen">
    <link rel="stylesheet" href="./css/forms.css">
    <link rel="stylesheet" href="css/main.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/header.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/footer.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/tables.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/profile.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/admin.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/pageLoader.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/pagination.css" type="text/css" media="screen">



    <link rel="stylesheet" href="./css/grilles.css" type="text/css" media="screen">



    <!-- Iconnes importees  -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

    <base href="<?php echo BASEURL; ?>">



    <script src="./js/main.js"></script>
    <script src="./js/admin.js"></script>
    <script src="./js/admin_recherche_triage.js"></script>
    <script src="./js/admin_usager.js"></script>



</head>

<body class="relative admin_body " id='admin_body'>

    <!-- Page Loader -->
    <div class="loader2 hidden">
        <img src="./assets/img/wine-Pageloader.gif" alt="" style=" width:150px;">
    </div>

    <div class="loader hidden">
        <ul>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <div>
            <div class="wineglass left">
                <div class="top"></div>
            </div>
            <div class="wineglass right">
                <div class="top"></div>
            </div>
        </div>
    </div>


    <!-- Entete et sideBar-->
    <header class="page-header">
        <nav>
            <!-- <span id="admin_menuToggle1" class=""> -->
            <input id="admin_menuToggle1" type="checkbox" class="toggle__input" />
            <i class="fas fa-bars burger menu_icon "></i>
            <i class="fas fa-times close menu_icon hidden"></i>

            <!-- </span> -->
            <a href="?requete=home" aria-label="logo" class="logo">
                <img src="assets/img/logo/logo_verre.svg" height="40" alt="">

            </a>


            <ul class="admin-menu admin__tabs__sidebar sideBar-ferme " id="admin_menu1">
                <!-- <li class="menu-heading">
                    <h3>Admin</h3>
                </li> -->

                <li class="tabs__button  admin_carte" data-for-tab="1">
                    <!-- <a href="#Catalogue"> -->
                    <a href="?requete=getCatalogue">
                        <picture class="admin_carte_img">
                            <img src="assets/img/site_img/catalogue.jpg" alt="">
                        </picture>
                        <div class="admin_carte-titre">
                            <h3>CATALOGUE</h3>
                            <hr />
                        </div><!-- /.title-content -->
                    </a>

                </li>


                <li class="tabs__button  admin_carte" data-for-tab="2">
                    <!-- <a href="#listeUsagers"> -->
                    <a href="?requete=getUsagersListe">

                        <picture class="admin_carte_img">
                            <img src="assets/img/site_img/usager.jpg" alt="">
                        </picture>
                        <div class="admin_carte-titre">
                            <h3>Usagers</h3>
                            <hr />

                        </div><!-- /.title-content -->
                    </a>
                </li>


                <li class="tabs__button  admin_carte" data-for-tab="3">
                    <a href="index.php?requete=home">
                        <picture class="admin_carte_img">
                            <img src="assets/img/site_img/admin_link3.jpg" alt="">
                        </picture>
                        <div class="admin_carte-titre">
                            <h3>Mes Celliers</h3>
                            <hr />

                        </div>
                    </a>
                </li>

                <li class="tabs__button admin_carte p-1 mt-9 importSAQ " data-for-tab="4">
                    <span class="admin_carte-titre p-1">
                        <h3>Importer de SAQ</h3>
                    </span>
                </li>


                <li>
                    <button class="collapse-btn">
                        <i class="fas fa-chevron-left"></i>
                        <span>Collapse</span>
                    </button>
                </li>
            </ul>
        </nav>
    </header>

    <main class="admin_main">
        <section class=" section_principale mt-5">

            <section class="search-and-user">

                <div class="admin__profile">
                    <span class="greeting">Bonjour admin!</span>
                    <div class="notifications u__profile_img_admin">
                        <i class="fas fa-user-tie "></i>
                    </div>

                    <div class=" u__profile-toggle_admin  col">
                        <form method="POST" action="index.php?requete=profileConnexion">
                            <button name="status" value="deconnexion">Déconnexion</button>
                        </form>
                    </div>
                </div>

            </section>


            <section class="grid admin_contenu_page">