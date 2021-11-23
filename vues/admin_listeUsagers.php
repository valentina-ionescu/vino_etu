<!-- Liste Usagers -->
<article class="admin__tabs__content liste_usagers" data-tab="2">

    <!-- Modal suppression  Usagers  -->
    <div class="usager__supprimer__modal__wrapper" id="usager__supprimer__modal__wrapper">
        <div class="modal__overlay">
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



    <h2>Liste Usagers </h2>
    <div class="form__recherche form__recherche--clair">
        <span class="fas fa-search iconne "></span>
        <!-- <input type="text" class="search-input" placeholder="Cherchez par nom"> -->

        <input type="text" id="cell_rech" class="form__recherche--clair recherche_usager" placeholder="Recherche par nom..." title="Nom de cellier">
    </div>
    <p class="txt_msg-usg-supprime"></p>

    <div class="mt-1">

        <table class="table_triable table_admin table_usagers">
            <thead>
                <tr>

                    <th class="nom_usager trier">Nom </th>
                    <th class="trier">Email</th>
                    <th>Admin?</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>
            <?php

            foreach ($listeUsager as $row) {

            ?>
                <tr data-row-id="<?php echo $row['id'] ?>" class="item">



                    <td >
                        <?php if ($row['admin'] == 1) {
                            echo $row['nom'] . " " . $row['prenom'] . ' <strong >(Admin)</strong>';
                        } else {
                            echo $row['nom'] . " " . $row['prenom'];
                        } ?>

                    </td>
                    <td ><?php echo $row['email']; ?></td>

                    <td class="admin-change relative">
                        <label class="switch">
                            <input class="transformAdminBtn" type="checkbox" name="admin" <?php if ($row['admin'] == 1)  echo 'checked="checked"'; ?> data-id="<?php echo $row['id'] ?>">
                            <span class="slider round"></span>
                        </label>
                    </td>





                    <td class="actions relative">

                        <span class="vino__id-hover hidden" data-id-hover=<?php echo $row['id'] ?>>Usager id - <?php echo $row['id'] ?></span>

                        <button class="trash  small btnSupprUsager" name="Delete" type="submit" data-id="<?php echo $row['id'] ?>" data-nom="<?php echo $row['prenom'] . ' ' . $row['nom'] ?>"><i class="fas fa-trash fa-xs"></i></button>


                    </td>




                </tr>

            <?php


            }

            ?>
            </tbody>
        </table>
    </div>


</article>