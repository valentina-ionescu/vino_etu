
      


            <!-- Catalogue Bouteilles -->
            <article class="admin__tabs__content admin__tabs__content--active mt-1" data-tab="1">


             




                <h2>Catalogue</h2>
                <p class="txt_msg-supprime"></p>
<a href="?requete=ajouterBouteilleNonListeeCatalogue" class="btn btn-primaire solid">Ajouter Une bouteill non listee</a>

                <div class="mt-1">

                    <!-- <span> <?php echo (count($listeBouteilles)); ?> Bouteilles </span> -->
                    


                    <table>
                        <tr>
                            <th>Type</th>
                            <th>Nom Bouteille</th>
                            <th class="hidden">Description </th>
                            <th>Url SAQ</th>
                            <th>Actions</th>

                        </tr>
                        <?php

                        foreach ($listeBouteilles as $row) {
                            if (!$row['statut_desactive'] == 1) {

                        ?>
                                <tr data-row-id="<?php echo $row['id'] ?>" class="item ">
                                    <td><i class="fas fa-wine-glass fa-2x" style="color:var(<?php if ($row['vino__type_id'] == 1) { ?>--bg-primaire <?php } else { ?>--bg-doree <?php } ?>); "></i></td>


                                    <td><?php echo $row['nom'] ?></td>
                                    <td class="hidden"><?php echo $row['description'] ?></td>

                                    <td><?php if ($row['url_saq'] != null) { ?>

                                            <a href="<?php echo $row['url_saq']; ?>">Lien SAQ
                                            <?php } else { ?>
                                                Non-listé <?php } ?>
                                    </td>

                                    <td class="actions relative"><span class="vino__id-hover hidden" data-id-hover=<?php echo $row['id'] ?>>Bouteille id - <?php echo $row['id'] ?></span>



                                        <form action="?requete=modifierBouteilleCatalogue" method="post" class="nostyle">

                                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">

                                            <button class="edit  small" name="Update" type="submit"><i class="fas fa-pen fa-xs"></i></button>

                                        </form>



                                        <button class="trash  small btnSuppr" name="Delete" type="submit" data-id="<?php echo $row['id'] ?>" data-nom-bouteille="<?php echo $row['nom'] ?>"><i class="fas fa-trash fa-xs"></i></button>


                                    </td>




                                </tr>


                        <?php
                            }
                        }

                        ?>
                    </table>
                </div>

                   <!-- Modal Desactivation bouteille -> supprimer -->
                   <div class="desactivation__modal__wrapper" id="desactivation__modal__wrapper">
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
            </article>








