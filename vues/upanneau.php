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

    <div class="msg-supprime"></div>
    <form class="flex btn__ajouter_cellier" method="POST" action="index.php?requete=ajouterCellier">
            <button class="u__ajout"><i class="fas fa-plus"></i></button>
        </form>
    <div class="u__celliers_liste u__contenu">
        <p>Mes celliers</p>
        <?php foreach ($dataC as $cle => $cel) { ?>
            <article class="u__article" data-cellid="<?php echo $cel['id'] ?>">
                <!-- <button class="selectCellier" data-cellid="<?php echo $cel['id'] ?>"><?php echo $cel['nom_cellier'] ?></button>  -->
                <i class="fas fa-circle b__compte"></i> <!--Nombre de bouteilles dans le cellier -->
                <a href="" class="selectCellier" data-cellid="<?php echo $cel['id'] ?>" ><?php echo ucfirst($cel['nom_cellier']) ?></a>
                <form  method="POST" action="index.php?requete=editCellier">
                    <button class="c__modif" name="id" value="<?php echo $cel['id'] ?>">
                        <i class="far fa-edit c__edit" data-cellid="<?php echo $cel['id'] ?>"></i> <!--Mise a jour d'un cellier -->
                    </button>
                </form>


                <i class="far fa-edit c__edit" data-cellid="<?php echo $cel['id'] ?>"></i> <!--Mise a jour d'un cellier -->
                <i class="far fa-trash-alt c__supp" data-cellid="<?php echo $cel['id'] ?>"></i><!--Suppression d'un cellier -->
            </article> <?php } ?>
       

    </div>
</div>

</section>        