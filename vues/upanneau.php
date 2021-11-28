<section class="light__wrapper">
    <div class="u__profile__wrapper">
        <div class="u__entete flex col">
            <div class="overlay flex">
                <h3 class="u__titre">Gestion des Celliers</h3>
            </div>
        </div>

        <!-- Modal de confirmation de suppression -->
        <div class="modal__wrapper">
            <div class="modal__overlay">
                <div class="modal__contenu flex col">
                    <span class="fermer"><i class="fas fa-times"></i></span>
                    <h3 class="modal__texte">Supprimer le cellier?</h3>
                    <div class="modal__buttons flex">
                        <button class="btn__annuler">Annuler</button>
                        <button class="btn__danger">Supprimer</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Fin de modal  -->

        <!-- Modal d'ajout de cellier -->
        <div class="modal__ajout-wrapper">
            <div class="modal__overlay">
                <div class="modal__contenu flex col">
                    <span class="fermer x__annuler"><i class="fas fa-times"></i></span>
                    <div class="form">
                        <div class="form__label__aj">
                            <input type="texte" name="nomCellier" required>
                            <label>Nom du cellier </label>
                            <input type="hidden" name="id">
                        </div>
                        <button class="btn btn-accent solid btnAjout" name="ajoutCellier">Ajouter le cellier</button>
                        <div class="msg-erreur"></div>

                        <!-- <button class="btn__annuler">Annuler</button> -->
                    </div>

                </div>
            </div>
            <!-- </div> -->
        </div>
        <!--Fin de modal  -->

        <!-- Modal de confirmationn d'ajout de bouteille -->
        <div class="modal__wrapper_ajout-bouteille">
            <div class="modal__overlay">
                <div class="modal__contenu flex col">
                    <span class="fermer"><i class="fas fa-times"></i></span>
                    <h3 class="modal__texte">Ce cellier est vide</h3>
                    <h4 class="modal__texte">Ajouter une bouteille?</h4>
                    <div class="modal__buttons flex">
                        <button class="btn__annuler">Annuler</button>
                        <button class="btn__ajout-bouteille">Ajouter</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Fin de modal  -->



        <div class="msg-supprime"></div>

        <div class="flex btn__ajouter_cellier">
            <button class="u__ajout"><i class="fas fa-plus"></i></button>
        </div>
        <div class="u__celliers_liste u__contenu">

            <?php if (!$dataC) { ?>
                <h4>Vous n'avez pas de celliers</h4>
            <?php } else { ?>
            <?php } ?>
            <div class="form__recherche form__recherche--clair">
                <span class="fas fa-search iconne cell__icon"></span>
                <input type="text" id="cell_rech" class="form__recherche--clair" placeholder="Recherche..." title="Nom de cellier">
            </div>

            <!-- Table de celliers -->
            <table class="table_triable">
                <thead>
                    <tr>
                        <th class="cell__col  nom trier th-tri-asc">Nom cellier</th>
                        <th class="cell__col  bouteilles trier">Bouteilles</th>
                        <th class="cell__col"></th>

                    </tr>
                </thead>
                <tbody id="cell__table">

                    <?php foreach ($dataC as $cle => $cel) { ?>


                        <tr class="cell__ligne" data-cellid="<?php echo $cel['id'] ?>">
                            <td><a href="" class="selectCellier" data-cellid="<?php echo $cel['id'] ?>"><?php echo ucfirst($cel['nom_cellier']) ?></a>
                            </td>
                            <td class="cell__col-qte b__compte"><?php if (empty($cel['bqte'])) echo 0;
                                                                else echo $cel['bqte']; ?></td>
                            <td>
                                <div class="actions">
                                    <form method="POST" action="index.php?requete=editCellier">
                                        <button class="c__modif" name="id" value="<?php echo $cel['id'] ?>">
                                            <i class="far fa-edit c__edit" data-cellid="<?php echo $cel['id'] ?>"></i>
                                        </button>
                                    </form>
                                    <i class="far fa-trash-alt c__supp" data-cellid="<?php echo $cel['id'] ?>"></i>
                                </div>
                            </td>
                           
                        </tr>



                    <?php } ?>




                </tbody>
            </table>

        </div>
    </div>

</section>