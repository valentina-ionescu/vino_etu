<section class="u__profile__wrapper">
    <div class="u__entete flex col">
        <div class="overlay flex">
            <h3 class="u__titre">Gestion des Celliers</h3>
        </div>
    </div>


    <div class="u__celliers_liste u__contenu">
        <p>Mes celliers</p>
        <?php foreach ($dataC as $cle => $cel) { ?>
            <article class="u__article">
                <!-- <button class="selectCellier" data-cellid="<?php echo $cel['id'] ?>"><?php echo $cel['nom_cellier'] ?></button>  -->
                <a href="" class="selectCellier" data-cellid="<?php echo $cel['id'] ?>"><?php echo $cel['nom_cellier'] ?></a><i class="far fa-trash-alt"></i>
            </article> <?php } ?>
        <form method="POST" action="index.php?requete=ajouterCellier">
            <button class="u__ajout"><i class="fas fa-plus"></i></button>
        </form>

    </div>
</section>