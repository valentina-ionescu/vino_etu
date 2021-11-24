<div class="form__contenant flex col " vertical layout>
    <!-- <div class="form__recherche form__recherche--clair">
        <input class="form__recherche--clair" type="text" placeholder="Entrer le nom de la bouteille..." name="nom_bouteille">

    </div> -->

    <div class="form_ajout_nonlistee form__carte ">
        <div class="admin_form__carte">
            <h4 class='m-1 text-center'>Ajouter une Bouteille non listée</h4>

            <!-- <div class="form__conteneur"> -->


            <!-- <div action="" class="form" enctype="multipart/form-data"> -->

            <div class="admin_form__modif flex col mt-3">

                <div class="form__label__md">
                    <label for="nom">Nom Bouteille </label>
                    <input type="text" id="nom" name="nom" required data-id="" class="nouvelle_bouteille" value="" placeholder="(min 3 caractère)">
                    
                </div>


                <div class="form__nonlistee-check flex row gap-3 justify-start">
                    <div class="flex column align-item-center">
                       
                        <input type="radio" checked name="vino__type_id" value="1"> 
                        <label>Rouge</label>
                    </div>
                    <div class="flex column align-item-center">
                        
                        <input type="radio" name="vino__type_id" value="2">
                        <label>Blanc</label>

                    </div>
                </div>

                <div class="form__label__md flex row align-item-center justify-start input_file">
                    <label for="image" class="btn_ajout_image"  id="btn_ajout_image">Image <i class="fas fa-upload"></i> </label>
                    <input id="image" type="file" name="image" class="form-control">
                    <span id="nom_image"></span>
                    
                </div>
            

               

                <div class="form__label__md">
                    <label>Pays </label>
                    <input type="text" name="pays" required placeholder="Ex: France">
                    
                </div>

                <div class="form__label__md">
                    <label>Format </label>
                    <input type="text" name="format" required placeholder="Ex: 750 ml">
                    
                </div>


                <div class="form__label__md">
                    <label>Prix </label>
                    <input type="text" name="prix" required placeholder="Ex: 20,35 $">
                    
                </div>


                <!-- <div class="form__label__md">
                    <input type="text" name="description" placeholder="Format: Vin rouge | 750 ml | France">
                    <label>Description </label>
                </div> -->

                <span class="hidden message__erreur__inscription" data-js-erreur-nonListee>
                    <p>Veuillez insérer un nom valide</p>
                </span>

                <button class="btn btn-accent solid ajoutNonlisteeBtn" type="submit">Ajouter la bouteille</button> 
                <!-- <a href="?requete=ajouterBouteilleNonListeeCatalogue" class="btn btn-accent solid" type="submit">Ajouter la bouteille</a> -->
                <button class="btn btn-primaire btnAnnul" type="reset">Annuler</button>
            </div>
        </div>
        <!-- </div> -->

        <!-- Modal confirmation ajout bouteille Catalogue-->

        <div class="confirm__modal__wrapper">
            <div class="modal__overlay">
                <div class="modal__contenu ">
                    <h3 class="modal__texte txt_msg-modif"></h3>
                </div>
            </div>
        </div>

    </div>
</div>