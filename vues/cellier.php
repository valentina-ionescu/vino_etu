<div class="cellier">
    <div class="cellier__information">
        <div class="cellier__information__wrapper flex row justify-start">
            <!-- <i class="fa fa-user cellier__information__icon"></i> -->
            <div class="nomCellier"></div>
        </div>
        <div class="cellier__information__wrapper">
           
        </div>
    </div>


    <div class="gallerie portail">


        <?php

        if (isset($_SESSION['cellier_id'])) {
            if($msg) ?>
            <h3 class="txt-blanc"><?php echo $msg;?></h3>
           
            <?php //var_dump($dataB);
             foreach ($dataB as $cle => $bouteille) {

        ?>

                <div class="modal__wrapper">
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

                <article class="bouteille carte no_padding horizontale relative align-item-center" data-quantite="">

                    <!-- HAUT DE LA CARTE LE TAG "TYPE DU VIN"-->

                    <div class="carte__tag-top  absolute">
                        <?php
                        if ($bouteille['vino__type_id'] == 1) { ?>
                            <span class="rouge">Vin rouge</span>
                        <?php } else { ?>
                            <span class="blanc ">Vin blanc </span>
                        <?php  } ?>

                    </div>

                    <div class="carte__top carte__start">
                        <picture class="carte__image flex column">

                            <img src="<?php echo $bouteille['image'] ?>" alt="bouteille de vin <?php echo $bouteille['nom'] ?>">

                        </picture>

                    </div>
                    <div class="carte__quantite column" data-id="<?php echo $bouteille['vino__bouteille_id'] ?>">

                        <i class="fas fa-wine-bottle btnAjouter">+</i>

                        <span class="quantite" data-js-cellier="<?php echo $bouteille['vino__bouteille_id'] ?>"><strong><?php echo $bouteille['quantite'] ?></strong> </span>

                        <i class="fas fa-wine-bottle btnBoire"> - </i>

                    </div>

                    <div class="carte__contenu">
                        <div class="carte__description">

                            <div class="carte__description__wrapper flex">
                                <h3 class="carte__description-nom "> <?php echo $bouteille['nom'] ?></h3>
                                <!-- Icone-bouton supprimer -->
                                <button class="carte__supp btnSupprimer" data-id="<?php echo $bouteille['id'] ?>"><i class="fas fa-times"></i></button>
                            </div>
                            <div class="flex row justify-between mt-1">
                                <p class="carte__description-pays"><?php echo $bouteille['pays'] ?></p>
                                <span class=" carte__format"><?php echo $bouteille['format'] ?> </span>
                            </div>
                            <p class="carte__description-millesime"><strong>Millesime:</strong> <?php echo $bouteille['millesime'] ?></p>



                            <div class="flex row justify-between mt-1 align-item-center">


                                <div class="carte__details-row">
                                    <div class="tabs">
                                        <div class="tab">
                                            <input class="note-input" type="checkbox" id="<?php echo $bouteille['id'] ?>">
                                            <label class="tab-label" for="<?php echo $bouteille['id'] ?>">Details</label>
                                            <div class="tab-content">
                                                <p class="carte__description-prix "><strong>Prix :</strong>

                                                    <span class="carte__prix">CAD <?php echo $bouteille['prix'] ?> </span>

                                                </p>

                                                <p class="date_achat"><strong>Date d'achat:</strong> <?php echo $bouteille['date_achat'] ?></p>
                                                <p class="garde_jusqua"><strong>Garde:</strong> <?php echo $bouteille['garde_jusqua'] ?></p>
                                                <?php if ($bouteille['notes'] != null) { ?>

                                                    <p class="date_achat"><strong>Note:</strong>
                                                        <?php echo $bouteille['notes'] ?>
                                                    </p>

                                                <?php } else { ?>
                                                    <span class=""><em>Pas de notes encore</em></span>

                                                <?php } ?>

                                                <form class="mt-1" action="?requete=modifierBouteilleCellier" method="POST">
                                                    <button name="id" class="btnCellierModif btn btn-accent solid" value="<?php echo $bouteille['id']; ?>" type="submit"> Modifier</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <a class="carte__lien" href="<?php echo $bouteille['url_saq'] ?>">Voir SAQ</a>
                            </div>
                        </div>

                    </div>


                </article><!-- fin de la carte -->

        <?php


            }
        }

        ?>



    </div>
</div>