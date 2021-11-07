<section class="u__profile__wrapper">
    <div class="u__entete flex col">
        <div class="overlay flex">
            <h3 class="u__titre">Gestion des Celliers</h3>
        </div>
    </div>


    <div class="u__celliers_liste u__contenu">
        <p>Mes celliers</p>
        <?php foreach ($dataC as $cle => $cel) { ?>
            <article class="u__article" data-cellid="<?php echo $cel['id'] ?>">
                <!-- <button class="selectCellier" data-cellid="<?php echo $cel['id'] ?>"><?php echo $cel['nom_cellier'] ?></button>  -->
                <i class="fas fa-circle b__compte"></i> <!--Nombre de bouteilles dans le cellier -->
                <a href="" class="selectCellier" ><?php echo ucfirst($cel['nom_cellier']) ?></a>
                <i class="far fa-edit c__edit"></i> <!--Mise a jour d'un cellier -->
                <i class="far fa-trash-alt c__supp"></i><!--Suppression d'un cellier -->
            </article> <?php } ?>
        <form method="POST" action="index.php?requete=ajouterCellier">
            <button class="u__ajout"><i class="fas fa-plus"></i></button>
        </form>

    </div>
</section>