


    <div class="form__contenant flex col" vertical layout>
        Recherche : <input type="text" name="nom_bouteille">
        <ul class="listeAutoComplete">

        </ul>
            <div class="form__carte" >
                <!-- a faire : ajouter required  - DK -->
               <div class="form__label">
                 <label>Nom </label>
                    <span data-id="" class="nom_bouteille"></span></p>
                </div>
                <div class="form__label">
                    <label>Millesime </label>
                    <input type="number" name="millesime">
                </div>
                <div class="form__label">
                    <label>Quantité </label>
                    <input type="number" name="quantite" value="1">
                </div>
                <div class="form__label">
                    <label>Date d'achat </label>
                    <input type="date" name="date_achat">
                </div>
                <div class="form__label">
                    <label>Prix </label>
                    <input type="number" name="prix">
                </div>
                <!-- un select ou nombre avec  min:0 max: 5 -->
              
                <div class="form__label">
                    <label>Garde </label>
                    <input type="number" min="0" max="5" name="garde_jusqua">
                </div>
                <div class="form__label">
                    <label>Notes </label>
                    <textarea name="notes" id="" cols="30" rows="5"></textarea>
                </div>
             
                <button name="ajouterBouteilleCellier">Ajouter la bouteille</button>
            </div>
       