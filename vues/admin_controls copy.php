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
    <link rel="stylesheet" href="./css/grilles.css" type="text/css" media="screen">
   


    <!-- Iconnes importees  -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

    <base href="<?php echo BASEURL; ?>">
    <!--<script src="./js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>-->
    <!-- <script src="./js/plugins.js"></script> -->
    
    
    <script src="./js/main.js"></script>
    <script src="./js/admin.js"></script>
    
</head>

<body class="relative admin_body ">

  <!-- Entete et sideBar-->
    <header class="page-header">
        <nav>
            <!-- <span id="admin_menuToggle1" class=""> -->
            <input id="admin_menuToggle1" type="checkbox" class="toggle__input" />
            <i class="fas fa-bars burger menu_icon "></i>
            <i class="fas fa-times close menu_icon "></i>

            <!-- </span> -->
            <a href="?requete=accueil" aria-label="logo" class="logo">
                <img src="assets/img/logo/logo_verre.svg" height="40" alt="">

            </a>


            <ul class="admin-menu admin__tabs__sidebar " id="admin_menu1">
                <li class="menu-heading">
                    <h3>Admin</h3>
                </li>

                <li class="tabs__button  tabs__button--active  admin_carte" data-for-tab="1">
                    <a href="#Catalogue">
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
                    <a href="#listeUsagers">
                        <picture class="admin_carte_img">
                            <img src="assets/img/site_img/usager.jpg" alt="">
                        </picture>
                        <div class="admin_carte-titre">
                            <h3>Usagers</h3>
                            <hr />

                        </div><!-- /.title-content -->
                    </a>
                </li>


                <!-- <li class="tabs__button  admin_carte" data-for-tab="3">

                    <picture class="admin_carte_img">
                        <img src="assets/img/site_img/admin_link3.jpg" alt="">
                    </picture>
                    <div class="admin_carte-titre">
                        <h3>Statistiques</h3>
                        <hr />

                    </div>
                </li> -->

                <li class="tabs__button admin_carte p-1 mt-9 " data-for-tab="4">
                    <a href="?requete=updateSAQ" class="admin_carte-titre p-1">
                        <h3>Importer de SAQ</h3>
                    </a>
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


    <section class="">

        <section class="search-and-user">

            <div class="admin__profile">
                <span class="greeting">Bonjour admin!</span>
                <div class="notifications">
                    <i class="fas fa-user-tie"></i>
                </div>
            </div>
        </section>


        <section class="grid admin_contenu_page">


            <!-- Catalogue Bouteilles -->
            <article class="admin__tabs__content admin__tabs__content--active" data-tab="1">

                <!-- Modal Desactivation bouteille -> supprimer -->
                <div class="desactivation__modal__wrapper">
                    <div class="modal__overlay">
                        <div class="modal__contenu flex col">
                            <span class="fermer"><i class="fas fa-times"></i></span>
                            <h3 class="modal__texte">Supprimer la bouteille?</h3>
                            <div class="modal__buttons flex">
                                <button class="btn__annuler">Annuler</button>
                                <button class="btn__danger">Supprimer</button>
                            </div>
                        </div>
                    </div>
                </div>







                


                <h2>Catalogue</h2>
                <p class="txt_msg-supprime"></p>

               
                <div class="mt-3">
 <a class="btn btn-primaire solid" href="?requete=ajouterBouteilleNonListeeCatalogue">Ajouter une bouteille Non Listée</a>
                    <!-- <span> <?php  echo (count($listeBouteilles)); $_SESSION['listeUsagers'] ?> Bouteilles </span> -->

                   

                    <table>
                        <tr>
                            <th>Id</th>
                            <th>Type</th>

                            <th>Nom Bouteille</th>
                            <th class="hidden">Description </th>
                            <th>Url SAQ</th>
                            <th>Actions</th>

                        </tr>
                        <?php

                        foreach ($listeBouteilles as $row) {
                            //  var_dump($row);
                            if (!$row['statut_desactive'] == 1) {

                        ?>
                                <tr data-row-id="<?php echo $row['id'] ?>">
                                    <td><?php echo $row['id'] ?></td>
                                    <td><i class="fas fa-wine-glass fa-2x" style="color:var(<?php if ($row['vino__type_id'] == 1) { ?>--bg-primaire <?php } else { ?>--bg-doree <?php } ?>); "></i></td>


                                    <td><?php echo $row['nom'] ?></td>
                                    <td class="hidden"><?php echo $row['description'] ?></td>

                                    <td><?php if ($row['url_saq'] != null) { ?>

                                            <a href="<?php echo $row['url_saq']; ?>">Lien SAQ
                                            <?php } else { ?>
                                                Non-listé <?php } ?>
                                    </td>

                                    <td class="actions">


                                        <form action="?requete=modifierBouteilleCatalogue" method="post" class="nostyle">

                                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">

                                            <button class="edit  small" name="Update" type="submit"><i class="fas fa-pen fa-xs"></i></button>

                                        </form>

                                        <!-- <form action="index.php?requete=desactiverBouteilleCatalogue" method="post" class="nostyle"> -->
                                            <!-- <input type="hidden" name="id" value="<?php echo $row['id'] ?>"> -->
                                            <!-- <button class="trash  small btnSupprimer" data-id="<?php echo $row['id'] ?>"><i class="fas fa-trash fa-xs"></i></button> -->

                                            <button class="trash  small btnSuppr" name="Delete" type="submit" data-id="<?php echo $row['id'] ?>"><i class="fas fa-trash fa-xs"></i></button>

                                        <!-- </form> -->

                                    </td>




                                </tr>

                        <?php
                            }
                        }

                        ?>
                    </table>
                </div>
                
            </article>

            <!-- Liste Usagers -->

            
            <article class="admin__tabs__content" data-tab="2">


  <!-- Modal Suppression Compte Usagers -> supprimer -->

                <!-- <div class="usager__supprimer__modal__wrapper">
                    <div class="modal__overlay">
                        <div class="modal__contenu flex col">
                            <span class="fermer"><i class="fas fa-times"></i></span>
                            <h3 class="modal__texte">Supprimer la bouteille?</h3>
                            <div class="modal__buttons flex">
                                <button class="btn__annuler">Annuler</button>
                                <button class="btn__danger">Supprimer</button>
                            </div>
                        </div>
                    </div>
                </div> -->








                <h2>Liste Usagers </h2>


                <div class="mt-3">
                    
                    <table>
                        <tr>
                            <th>Id</th>
                            <!-- <th>Image</th> -->
                            <th>Nom </th>
                            <th>Email</th>

                            <th>Username</th>
                            <th>Actions</th>

                        </tr>
                        <?php

                        foreach ($listeUsager as $row) {

                        ?>
                            <tr>
                                <td><?php echo $row['id'] ?></td>
                                <!-- <td><i class="fas fa-user fa-2x" ></i></td> -->


                                <td><?php if( $row['admin']==1){echo $row['nom'] . " " . $row['prenom'].' <strong >(Admin)</strong>';} 
                                else{  echo $row['nom'] . " " . $row['prenom']; } ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['username']; ?></td>


                                <td class="actions">


                                    <form action="studentForm/showUpdateStudent" method="post" class="nostyle">

                                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">

                                        <button class="edit  small" name="Update" type="submit"><i class="fas fa-pen fa-xs"></i></button>

                                    </form>

                                    <!-- <form action="" method="post" class="nostyle"> -->
                                        <!-- <input type="hidden" name="id" value="<?php echo $row['id'] ?>"> -->

                                        <!-- <button class="trash  small "  name="Delete" type="submit"><i class="fas fa-trash fa-xs"></i></button> -->
                                        <button class="trash  small btnSupprUsager" name="Delete" type="submit" data-id="<?php echo $row['id'] ?>" data-nom="<?php echo $row['prenom'].''.$row['nom'] ?>"><i class="fas fa-trash fa-xs"></i></button>

                                    <!-- </form> -->

                                </td>




                            </tr>

                        <?php


                        }

                        ?>
                    </table>
                </div>

                <!-- php pour generer table catalogue-->

            </article>

            
            <!-- <article class="admin__tabs__content" data-tab="3">

                <h2>Statistiques</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae deserunt animi distinctio sit voluptates? Nisi sit et quos similique, nihil nulla cupiditate voluptatibus quis facilis, modi maxime cum obcaecati dicta?</p>
                <p>
                    Lorem, ipsum dolor.
                </p>


            </article> -->




        </section>

    </section>





</body>

</html>