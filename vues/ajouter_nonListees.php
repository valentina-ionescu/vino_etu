<div class="form__contenant flex col form__contenant--espacevertical" vertical layout>
    <!-- <div class="form__recherche form__recherche--clair">
        <input class="form__recherche--clair" type="text" placeholder="Entrer le nom de la bouteille..." name="nom_bouteille">

    </div> -->

    <div class="form__carte">

        <h3 data-id="" class="nom_bouteille carte__description-nom"></h3>

        <div class="form__conteneur">


            <div class="form">

                <div class="form__label__aj">
                    <input type="text" id="nom" name="nom" required data-id="" class="nouvelle_bouteille" value="">
                    <label for="nom">Nom Bouteille </label>
                </div>

                <div class="form__label__aj">
                    <label for="image" class=" ">Ajouter L'image</label>
                    <input id="image" type="file" name="image" class="form-control">
                </div>

                <div class="form__label__md">
                    <label>Vin rouge</label>
                    <input type="checkbox" name="vino__type_id"  value="1">
                    <label>Vin blank</label>
                    <input type="checkbox" name="vino__type_id"  value="2">
                </div>

                <div class="form__label__aj">
                    <input type="text" name="pays" required>
                    <label>Pays </label>
                </div>

                <div class="form__label__aj">
                    <input type="text" name="format" required placeholder="Ex: 750 ml">
                    <label>Format </label>
                </div>


                <div class="form__label__aj">
                    <input type="text" name="prix" required>
                    <label>Prix </label>
                </div>


                <div class="form__label__aj">
                    <input type="text" name="description" placeholder="Format: Vin rouge | 750 ml | France">
                    <label>Description </label>
                </div>

                <button class="btn btn-accent solid" name="ajouterBouteilleCatalogue">Ajouter la bouteille</button>

            </div>
        </div>

    </div>