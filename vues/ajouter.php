<div class="form__contenant flex col form__contenant--espacevertical form__ajout_bouteille" vertical layout>
   

 <!-- Modal confirmation modification bouteille Catalogue-->
            
    <div class="confirm__modal__wrapper">
                                <div class="modal__overlay">
                        <div class="modal__contenu ">
                            <h3 class="modal__texte txt_msg-modif"></h3>
                        </div>
                    </div>
    </div>
            
            
<div class="form__carte">

     

        <div class="form__conteneur">

            <div class="form">
                <div class="form__label__aj">
                    <div class="form__recherche form__recherche--clair">
                        <span class="fas fa-search iconne searchIconeBtn"></span>
                        <i class="fas fa-close iconne clearSearchBtn hidden"></i>
                        <input class="form__recherche--clair" type="text" placeholder="Entrer le nom de la bouteille..." name="nom_bouteille" data-id="" >
                        

                 



                        <ul class="listeAutoComplete form__contenant__liste">

                        </ul>
                    </div>
                 
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
                    <button class="btn btn-primaire btnAnnul mt-10px">Annuler</button>
                </form>

            </div>
        </div>

    </div>