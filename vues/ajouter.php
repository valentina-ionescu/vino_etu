


    <div class="form__contenant flex col form__contenant--espacevertical" vertical layout>
            <div class="form__recherche form__recherche--clair">
                 <!-- <label><i class="fas fa-search"></i> </label> -->
                 <input class="form__recherche--clair"  type="text" placeholder="Entrer le nom..." name="nom_bouteille"> 
               
  

                 <ul class="listeAutoComplete">
         
                 </ul>
            </div>
       
            <div class="form__carte" >
                <!-- a faire : ajouter required  - DK -->
               
                 <!-- <label>Nom </label> -->
                    <h3 data-id="" class="nom_bouteille"></h3>
               
                <div class="form__conteneur">

                    <div class="form">
                        <div class="form__label__aj">
                            <input type="number" name="millesime" required>
                            <label >Millesime </label>
                        </div>
                        <div class="form__label__aj">
                            <input type="number" name="quantite" required>
                            <label>Quantité </label>
                        </div>
                        <div class="form__label__aj">
                            <input type="date" name="date_achat" required>
                            <label>Date d'achat </label>
                        </div>
                        <div class="form__label__aj">
                            <input type="number" name="prix" required>
                            <label>Prix </label>
                        </div>
                        <!-- un select ou nombre avec  min:0 max: 5 -->
                      
                        <div class="form__label__aj">
                            <input type="text" name="garde_jusqua" required>
                            <label>Garde </label>
                        </div>
                        <div class="form__label__aj">
                            <textarea name="notes" id=""  rows="5" required></textarea>
                            <label>Notes </label>
                        </div>
                    </div>
                 
                </div>
                <button name="ajouterBouteilleCellier">Ajouter la bouteille</button>
            </div>
       