


    <div class="form__contenant flex col form__contenant--espacevertical" vertical layout>
            <div class="form__recherche form__recherche--clair">
                 <!-- <label><i class="fas fa-search"></i> </label> -->
                 <input class="form__recherche--clair"  type="text" placeholder="Entrer le nom..." name="nom_bouteille"> 
               
  

            </div>
       
        <ul class="listeAutoComplete">

        </ul>
            <div class="form__carte" >
                <!-- a faire : ajouter required  - DK -->
               
                 <!-- <label>Nom </label> -->
                    <h3 data-id="" class="nom_bouteille"></h3>
               
                <div class="form__ajouter">
                    <div class="form__label">
                        <label class="form__ajouter__label">Millesime </label>
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
                        <input type="text" name="garde_jusqua">
                    </div>
                    <div class="form__label">
                        <label>Notes </label>
                        <textarea name="notes" id="" cols="30" rows="5"></textarea>
                    </div>
                 
                </div>
                <button name="ajouterBouteilleCellier">Ajouter la bouteille</button>
            </div>
       