<div class="form__contenant flex col form__contenant--espacevertical" vertical layout>
    <div class="form__recherche form__recherche--clair">
        <span class="fas fa-search iconne"></span>
        <input class="form__recherche--clair" type="text" placeholder="Entrer le nom de la bouteille..." name="nom_bouteille">
        


        <ul class="listeAutoComplete form__contenant__liste">

        </ul>
    </div>

    <div class="form__carte">

        <!-- <h3 data-id="" class="nom_bouteille carte__description-nom"></h3> -->

        <div class="form__conteneur">

            <div class="form">
                <div class="form__label__aj">
                    <input type="text" id="nom" name="nom" required data-id="" class="nouvelle_bouteille" value="">
                    <label for="nom">Nom Bouteille </label>
                </div> 

                <div class="form__label__aj">
                    <input type="number" name="millesime" required>
                    <label>Millesime </label>
                </div>
                <div class="form__label__aj">
                    <input type="number" name="quantite" value="1" required>
                    <label>Quantité </label>
                </div>
                <div class="form__label__aj">
                    <input type="date" name="date_achat" value="<?php echo date('Y-m-d'); ?>" required>
                    <label>Date d'achat </label>
                </div>
                <div class="form__label__aj">
                    <input type="text" name="prix" required>
                    <label>Prix </label>
                </div>
                <div class="form__label__aj">
                    <input type="text" name="garde_jusqua" required>
                    <label>Garde </label>
                </div>

                <button class="mt-1 btn btn-accent solid" name="ajouterBouteilleCellier">Ajouter la bouteille</button>
                <form method="POST" action="index.php?requete=accueil">
                    <button class="btn btn-primaire btnAnnul mt-10px" >Annuler</button>
                </form>

            </div>
        </div>

    </div>