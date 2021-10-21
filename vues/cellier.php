<div class="cellier">
    <div class="grid portal no_padding">
        <?php
        foreach ($data as $cle => $bouteille) {

        ?>
            <div class="bouteille card" data-quantite="">
                <div class="img card_image">

                    <img src="https:<?php echo $bouteille['image'] ?>">
                </div>
                <div class="description">

                    <p class="nom">Nom : <?php echo $bouteille['nom'] ?></p>
                    <p class="quantite" data-js-cellier="<?php echo $bouteille['vino__bouteille_id']?>">Quantité : <?php echo $bouteille['quantite'] ?></p>
                    <p class="pays">Pays : <?php echo $bouteille['pays'] ?></p>
                    <p class="type">Type : <?php echo $bouteille['vino__type_id'] ?></p>
                    <p class="millesime">Millesime : <?php echo $bouteille['millesime'] ?></p>
                    <p class="prix">Prix : <?php echo $bouteille['prix'] ?></p>
                    <p class="date_achat">Date d'achat : <?php echo $bouteille['date_achat'] ?></p>
                    <p class="garde_jusqua">Garde : <?php echo $bouteille['garde_jusqua'] ?></p>
                    <p class="notes">Notes : <?php echo $bouteille['notes'] ?></p>
                    <p><a href="<?php echo $bouteille['url_saq'] ?>">Voir SAQ</a></p>
                </div>
                <div class="options bottom50" data-id="<?php echo $bouteille['vino__bouteille_id'] ?>">
                    <form action="?requete=modifierBouteilleCellier" method="POST"><button name="id" value="<?php echo $bouteille['id']; ?>" type="submit">Modifier</button></form>
                    <button class='btnAjouter'>Ajouter</button>
                    <button class='btnBoire'>Boire</button>

                </div>
            </div>
        <?php


        }

        ?>
    </div>
</div>