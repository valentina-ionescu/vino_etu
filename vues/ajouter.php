<div class="form__contenant flex col form__contenant--espacevertical" vertical layout>
    <div class="form__recherche form__recherche--clair">
        <input class="form__recherche--clair" type="text" placeholder="Entrer le nom de la bouteille..." name="nom_bouteille">



        <ul class="listeAutoComplete form__contenant__liste">

        </ul>
    </div>

    <div class="form__carte">
      
        <h3 data-id="" class="nom_bouteille carte__description-nom"></h3>
      
        <div class="form__conteneur">
           
            <div class="form">
                <!-- <div class="form__label__aj">
                    <input type="text" name="nom" placeholder="Nom" class="nom_bouteille" required>
                </div> -->
                <div class="form__label__aj">
                    <input type="number" name="millesime" placeholder="Millesime" required>
                    <!-- <label>Millesime </label> -->
                </div>
                <div class="form__label__aj">
                    <input type="number" name="quantite" placeholder="Quantité" value="1" required>
                    <!-- <label>Quantité </label> -->
                </div>
                <div class="form__label__aj">
                    <input type="date" name="date_achat" placeholder="Date d'achat"  value="<?php echo date('Y-m-d');?>" required>
                    <!-- <label>Date d'achat </label> -->
                </div>
                <div class="form__label__aj">
                    <input type="text"  placeholder="Prix" name="prix" required>
                    <!-- <label>Prix </label> -->
                </div>
                <div class="form__label__aj">
                    <input type="text" placeholder="Garde" name="garde_jusqua" required>
                    <!-- <label>Garde </label> -->
                </div>
                
                <button class="btn btn-accent solid" name="ajouterBouteilleCellier">Ajouter la bouteille</button>
            </div>
          
            
        </div>
    </div>