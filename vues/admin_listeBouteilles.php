<!-- Catalogue Bouteilles -->
<article class="admin__tabs__content  mt-1 admin__tabs__content--active catalog" data-tab="1">

    <!-- admin__tabs__content--active -->




<div class="nom_et_recherche">
    
        <h2>Catalogue</h2>
    
        <a href="?requete=ajouterBouteilleNonListeeCatalogue" class="btn btn-primaire solid admin ajoute-bouteille">Ajouter une bouteille non listée</a>
</div>

    <div class="form__recherche form__recherche--clair">
        <a href="" class="btnRechercheBouteille"> <span class="fas fa-search iconne "></span></a>
        <!-- <input type="text" class="search-input" placeholder="Cherchez par nom"> -->

        <input type="text" id="cell_rech" name="recherche" class="form__recherche--clair recherche_bouteille" placeholder="Recherche par nom..." title="Nom de cellier">
    </div>

    <p class="txt_msg-supprime"></p>



    <div class="mt-1">

        <ul class="pagination">

            <li><a href="<?php echo $urlPage ?>1"><i class="fas fa-angle-double-left"></i></a></li>
            <li class="<?php if ($page <= 1) {
                            echo 'disabled';
                        } ?>">
                <a href="<?php if ($page <= 1) {
                                echo '#';
                            } else {
                                echo $urlPage . ($page - 1);
                            } ?>">Précédent</a>
            </li>
            <li class="disabled small-txt"><span>Page <?php echo $page; ?> de <?php echo $number_of_page; ?></span></li>

            <li class="<?php if ($page >= $number_of_page) {
                            echo 'disabled';
                        } ?>">
                <a href="<?php if ($page >= $number_of_page) {
                                echo '#';
                            } else {
                                echo "$urlPage " . ($page + 1);
                            } ?>">Suivant</a>
            </li>

            <li><a href=" <?php if ($page >= $number_of_page) {
                                echo '#';
                            } else {
                                echo  $urlPage . $number_of_page;;
                            } ?> "><i class="fas fa-angle-double-right"></i></a></li>

            <?php
            if (isset($_GET['rech'])) {   ?>
                <a class="admin btn-primaire solid p-1 btn_anule_recherche" href="index.php?requete=getCatalogue" ><i class="fas fa-window-close"></i></a>

            <?php } ?>

        </ul>

        <?php if (count($resultatPage) > 0) { ?>

            <table class="table_triable table_admin table_bouteilles">
                <thead>
                    <tr>
                        <th class="trier">Type</th>
                        <th class="nom_bouteille trier">Nom Bouteille</th>
                        <th class="hidden">Description </th>
                        <th>Url SAQ</th>
                        <th>Actions</th>

                    </tr>

                </thead>
                <tbody>
                    <?php

                    foreach ($resultatPage as $row) {
                        if (!$row['statut_desactive'] == 1) {

                    ?>
                            <tr data-row-id="<?php echo $row['id'] ?>" class="item ">
                                <!-- <td><i class="fas fa-wine-glass fa-2x" style="color:var(<?php if ($row['vino__type_id'] == 1) { ?>--txt-medium <?php } else { ?>--bg-doree <?php } ?>); font-size:18px; "></i></td> -->

                                <td><?php if ($row['vino__type_id'] == 3) { ?><i class="fas fa-wine-glass fa-2x" style="color:var(--bg-rose); font-size:18px;"><span class="hidden">Rose</span></i><?php } else if ($row['vino__type_id'] == 2) { ?><i class="fas fa-wine-glass fa-2x" style="color:var(--bg-doree ); font-size:18px;"><span class="hidden">Blanc</span></i><?php } else { ?><i class="fas fa-wine-glass fa-2x" style="color:var(--bg-accent-admin ); font-size:18px;"><span class="hidden">Rouge</span></i><?php } ?></td>


                                <td><?php echo $row['nom'] ?></td>
                                <td class="hidden"><?php echo $row['description'] ?></td>

                                <td><?php if ($row['url_saq'] != null) { ?>

                                        <a href="<?php echo $row['url_saq']; ?>">Lien SAQ
                                        <?php } else { ?>
                                            Non-listé <?php } ?>
                                </td>

                                <td class="actions relative">
                                    <span class="vino__id-hover hidden" data-id-hover=<?php echo $row['id'] ?>>Bouteille id - <?php echo $row['id'] ?></span>


                                    <div class="flex row">

                                        <form action="?requete=modifierBouteilleCatalogue" method="post" class="nostyle">

                                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">

                                            <button class="edit  small" name="Update" type="submit"><i class="fas fa-pen fa-xs"></i></button>

                                        </form>



                                        <button class="trash  small btnSuppr" name="Delete" type="submit" data-id="<?php echo $row['id'] ?>" data-nom-bouteille="<?php echo $row['nom'] ?>"><i class="fas fa-trash fa-xs"></i></button>
                                    </div>


                                </td>




                            </tr>


                    <?php
                        }
                    }

                    ?>
                </tbody>
            </table>

        <?php } else { ?>

            <p>Aucun résultat :(</p>
        <?php } ?>
    </div>

    <!-- Modal Desactivation bouteille -> supprimer -->
    <div class="desactivation__modal__wrapper" id="desactivation__modal__wrapper">
        <div class="modal__overlay no-bg">
            <div class="modal__contenu flex col">
                <span class="fermer"><i class="fas fa-times"></i></span>
                <p class="modal__texte">Supprimer la bouteille?</p>
                <div class="modal__buttons flex">
                    <button class="btn__annuler">Annuler</button>
                    <button class="btn__danger">Supprimer</button>
                </div>
            </div>
        </div>
    </div>
</article>