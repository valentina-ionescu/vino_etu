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
            <span class="checkbox__wrapper">
                <p>Bouteille personnalisée</p>
                <span><input class="checkAjout" name="checkbox" type="checkbox" id="switch" /><label class="checkLabel" for="switch">Toggle</label></span>
            </span>
        </div>        
   
    <div class="form__carte form__ajout">
        <div class="form__carte">
            <div class="form__conteneur">
                <div data-js-form-personel class="form hidden">

                    <div class="form__label__aj">
                        <input type="texte" name="nom" required>
                        <label>Nom <small>(min 3 caractères)</small></label>
                    </div>

                    <div class="form__label__aj flex row align-item-center justify-start input_file mt-2">
                        <label for="imagePerso" class="btn_ajout_image image__image" id="btn_ajout_image">Image <i class="fas fa-upload"></i> </label>
                        <input id="imagePerso" type="file" name="image" class="form-control">
                        <span id="nom_imagePerso"></span>

                    </div>





                    <!-- <div class="form__label__aj">
                        <p class="image__image"> Image </p>
                            <input id="image" type="file" name="image" class="form-control">
                        
                    </div> -->



                    <div class="form__label__aj">
                        <input type="texte" name="pays" required>
                        <label>Pays d'origine</label>
                    </div>
                    <div class="form__label__aj">
                        <input type="texte" name="prix_perso" required>
                        <label>Prix <small>(CAD)</small></label>
                    </div>
                    <div class="form__label__aj">
                        <input type="texte" name="format" required>
                        <label>Format </label>
                    </div>
                    <div class="form__label__aj">
                        <select required name="type" id="">
                            <option value="" disabled selected>Type</option>
                            <option value="2">Blanc</option>
                            <option value="1">Rouge</option>
                        </select>
                    </div><br>
                    <p data-js-erreur-inserer class="message__erreur__inscription hidden">Veuillez entrer un nom valide</p>
                    <button class="mt-1 btn btn-accent solid" name="ajouterBouteillePersonnalisé">Inserer la bouteille</button>
                    <form method="POST" action="index.php?requete=ajouterNouvelleBouteilleCellier">
                        <button class="btn btn-primaire btnAnnul mt-10px">Annuler</button>
                    </form>
                </div>
                <div data-js-form-public class="form">
                    <div class="form__label__aj">
                        <div class="form__recherche form__recherche--clair">
                            <span class="fas fa-search iconne searchIconeBtn"></span>
                            <i class="fas fa-close iconne clearSearchBtn hidden"></i>
                            <input data-js-search class="form__recherche--clair" type="text" placeholder="Entrer le nom de la bouteille..." name="nom_bouteille" data-id="">

                            <ul class="listeAutoComplete form__contenant__liste">

                            </ul>
                        </div>

                    </div>

                    <!-- <button class="mt-1 btn btn-accent solid" name="ajouterBouteilleCellier">Ajouter la bouteille</button>
                <form method="POST" action="index.php?requete=home">
                    <button class="btn btn-primaire btnAnnul mt-10px">Annuler</button>
                </form> -->

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
                        <label>Prix <small>(CAD)</small></label>
                    </div>
                    <div class="form__label__aj">
                        <input type="text" name="garde_jusqua" required>
                        <label>Garde </label>
                    </div>
                    <p data-js-erreur_ajout class="message__erreur__inscription hidden">Veuillez saisir une bouteille valide</p>
                    <button class="mt-1 btn btn-accent solid" name="ajouterBouteilleCellier">Ajouter la bouteille</button>
                    <form method="POST" action="index.php?requete=home">
                        <button class="btn btn-primaire btnAnnul mt-10px">Annuler</button>
                    </form>

                </div>
            </div>

        </div>