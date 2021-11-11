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
                    <!-- <button class="btn__annuler">Annuler</button> -->
                </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!--Fin de modal  -->



        <div class="msg-supprime"></div>
        <!-- <form class="flex btn__ajouter_cellier" method="POST" action="index.php?requete=ajouterCellier"> -->
        <div class="flex btn__ajouter_cellier">
            <button class="u__ajout"><i class="fas fa-plus"></i></button>
        </div>
        <div class="u__celliers_liste u__contenu">
            <?php if(!$dataC) {?>
            <h4>Vous n'avez pas de celliers</h4>
            <?php } else { ?>
            <h4 class="u__titre-m">Mes celliers</h4>
            <?php } ?>
            
            <?php foreach ($dataC as $cle => $cel) { ?>
                <article class="u__article" data-cellid="<?php echo $cel['id'] ?>">
                    
                
                    <!--Nombre de bouteilles dans le cellier -->
                    <i class="fas fa-circle b__compte"></i><?php #echo $cel['count'];?>
                    
                    <!-- Nom du cellier -->
                    <a href="" class="selectCellier" data-cellid="<?php echo $cel['id'] ?>"><?php echo ucfirst($cel['nom_cellier']) ?></a>
                    
                    <!--Mise a jour d'un cellier -->
                    <form method="POST" action="index.php?requete=editCellier">
                        <button class="c__modif" name="id" value="<?php echo $cel['id'] ?>">
                            <i class="far fa-edit c__edit" data-cellid="<?php echo $cel['id'] ?>"></i>
                        </button>
                    </form>


                      <!--Suppression d'un cellier -->
                    <i class="far fa-trash-alt c__supp" data-cellid="<?php echo $cel['id'] ?>"></i>

                  
                </article> <?php } ?>


        </div>
    </div>

</section>