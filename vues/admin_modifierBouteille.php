<div class="form__contenant flex col " vertical layout>
    <div class="admin_form__carte">

    <h4 class='m-1 text-center'> Modification de la bouteille No. <?php  echo $_POST['id'] ?>.</h4>
        <!-- <?php var_dump($row)  ?> -->
        <!-- <div class="form__image flex">
            <img src="<?php echo $row['image'] ?>" alt="">
        </div> -->
        <div class="admin_form__modif flex col mt-3">
            <!-- <h3 data-id="<?php echo $_POST['id'] ?>"><?php echo $row['nom']; ?></h3> -->
            <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
            <div class="form__label__md">
                <label>Nom </label>
                <input type="text" name="nom" value="<?php echo $row['nom']; ?>">

            </div>
            <div class="form__label__md">
                <label>Format Bouteille </label>
                <input type="text" name="format" value="<?php echo $row['format']; ?>">
            </div>

            <div class="form__label__md">
                <label>Image URL </label>
                <input type="text" name="image" value="<?php echo $row['image']; ?>">

            </div>
            <div class="form__label__md">
                <label>Code SAQ</label>
                <input type="text" name="code_saq" value="<?php echo $row['code_saq']; ?>">

            </div>
            <div class="form__label__md">
                <label>Pays</label>
                <input type="text" name="pays" value="<?php echo $row['pays']; ?>">

            </div>

            <div class="form__label__md">
                <label>Prix </label>
                <input type="text" name="prix_saq" value="<?php echo $row['prix_saq']; ?>">

            </div>
            <div class="form__label__md">
                <label>Link_SAQ</label>
                <input type="text" name="url_saq" value="<?php echo $row['url_saq']; ?>">

            </div>
            <!-- <?php echo $row["vino__type_id"]; ?> -->

             <!-- Modal confirmation modification bouteille Catalogue-->
             <div class="confirm__modal__wrapper">
                    <div class="modal__overlay">
                        <div class="modal__contenu ">
                            <h3 class="modal__texte txt_msg-modif"></h3>
                        </div>
                    </div>
                </div>

           


            <button class="btnModifierBouteilleCatalogue" type = "submit" >Modifier la bouteille</button>

            <button class="btn btn-primaire btnAnnul" type="reset">Annuler</button>
        </div>
    </div>
</div>
