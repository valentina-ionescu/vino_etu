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
                    <input type="text" id="nom" name="nom" required data-id="" class="nouvelle_bouteille" value="">
                    
                </div>


                <div class="form__nonlistee-check flex row ">
                    <div class="flex column align-item-center">
                       
                        <input type="radio" name="vino__type_id" value="1"> 
                        <label>Rouge</label>
                    </div>
                    <div class="flex column align-item-center">
                        
                        <input type="radio" name="vino__type_id" value="2">
                        <label>Blanc</label>

                    </div>
                </div>

                <div class="form__label__md">
                    <label for="image" class=" ">Ajouter L'image</label>
                    <input id="image" type="file" name="image" class="form-control">
                    
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

                <button class="btn btn-accent solid ajoutNonlisteeBtn" type="submit">Ajouter la bouteille</button> 
                <!-- <a href="?requete=ajouterBouteilleNonListeeCatalogue" class="btn btn-accent solid" type="submit">Ajouter la bouteille</a> -->

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