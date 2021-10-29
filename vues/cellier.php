<div class="cellier">
    <div class="cellier__information">
        <div class="cellier__information__wrapper flex row justify-start">
            <i class="fa fa-user cellier__information__icon"></i>
            <h2> 
                <?php
                if (isset($_SESSION['nom'])) {
                    echo "Bonjour ". $_SESSION['prenom'] ."!";
                    // echo ' ' . $_SESSION['nom'];
                ?>
            </h2>
        </div>
        <div class="cellier__information__wrapper">
            <!-- <i class="fas fa-wine-glass-alt cellier__information__icon"></i> -->
            <span class="center">
                <div class="select"> 
                <select name="selectCellier" id="">
                    <option value="" disabled selected>Choisiser votre cellier</option>
                    <?php foreach ($dataC as $cle => $cellier) { ?>
                        <option value="<?php echo $cellier['id'] ?>"><?php echo $cellier['nom_cellier'] ?></option>
                    <?php }                 } else {
                    echo 'Vous n\'êtes pas connecté';
                }?>
                </select>
                </div>
            </span>
            <h2 class="center txt-primary ">Une bouteille a la fois! </h2>

        </div>
    </div>
    <div class="gallerie portail">




        <?php

        if (isset($_SESSION['cellier_id'])) {
            foreach ($dataB as $cle => $bouteille) {

        ?>
            <article class="bouteille carte no_padding " data-quantite="">

                <div class="carte__tag-top  ">
                    <?php
                    if ($bouteille['vino__type_id'] == 1) { ?>
                        <span class="rouge">Vin rouge</span>
                    <?php } else { ?>
                        <span class="blanc ">Vin blanc </span>
                    <?php  }
                    ?>


                </div>
                <div class="carte__top">
                    <picture class="carte__image relative">

                        <img src="<?php echo $bouteille['image'] ?>" alt="bouteille de vin <?php echo $bouteille['nom'] ?>">

                        <span class="absolute carte__format"><?php echo $bouteille['format'] ?> </span>

                    </picture>
                    <div class="carte__quantite" data-id="<?php echo $bouteille['vino__bouteille_id'] ?>">

                        <i class="fas fa-wine-bottle btnAjouter">+</i>

                        <span class="quantite" data-js-cellier="<?php echo $bouteille['vino__bouteille_id'] ?>"><strong><?php echo $bouteille['quantite'] ?></strong> bouteilles </span>

                        <i class="fas fa-wine-bottle btnBoire"> - </i>

                        <!-- <button class='btnBoire'>Boire</button> -->
                    </div>

                </div>
                <div class="carte__contenu">
                    <div class="carte__description">

                        <h3 class="carte__description-nom "> <?php echo $bouteille['nom'] ?></h3>


                        <div class="flex row justify-between mt-1">
                            <p class="carte__description-pays"><?php echo $bouteille['pays'] ?></p>
                            <p class="carte__description-millesime"><strong>Millesime:</strong> <?php echo $bouteille['millesime'] ?></p>
                        </div>

                        <p class="date_achat"><strong>Date d'achat:</strong> <?php echo $bouteille['date_achat'] ?></p>
                        <p class="garde_jusqua"><strong>Garde:</strong> <?php echo $bouteille['garde_jusqua'] ?></p>

                        <?php if ($bouteille['notes'] != null) { ?>

                            <details>
                                <summary>Notes</summary>
                                <?php echo $bouteille['notes'] ?>
                            </details>

                        <?php } else { ?>
                            <span class=""><em>Pas de notes encore</em></span>

                        <?php } ?>
                        <div class="carte__description-prix flex row justify-between mt-1">
                            <p><strong>Prix :</strong>

                                <span class="carte__prix">CAD <?php echo $bouteille['prix'] ?> </span>

                            </p>

                            <a class="carte__lien" href="<?php echo $bouteille['url_saq'] ?>">Voir SAQ</a>
                        </div>



                    </div>
                    <div class="options carte__pied " data-id="<?php echo $bouteille['vino__bouteille_id'] ?>">
                        <form action="?requete=modifierBouteilleCellier" method="POST">
                            <button name="id" class="btnCellierModif btn btn-accent solid" value="<?php echo $bouteille['id']; ?>" type="submit"> Modifier</button>
                        </form>

                        <!-- <button class='btnBoire'>Boire</button> -->
                    </div>
                </div>
            </article>

        <?php


        }
    }

        ?>
    </div>
</div>