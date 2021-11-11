<div class="form__contenant flex col mt-1" vertical layout>
<h4 class='m-1 text-center'> Modification du compte Usager - <?php  echo $row['nom']." ".$row['prenom']  ?>.</h4>
    <div class="admin_form__carte">
        <!-- <?php var_dump($row)  ?> -->
       
        <div class="admin_form__modif flex col  ">

            <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
            <div class="form__label__md">
                <label>Nom </label>
                <input type="text" name="nom" value="<?php echo $row['nom']; ?>">
            </div>
            <div class="form__label__md">
                <label>Prenom </label>
                <input type="text" name="prenom" value="<?php echo $row['prenom']; ?>">
            </div>

            <div class="form__label__md">
                <label>Courriel </label>
                <input type="text" name="email" value="<?php echo $row['email']; ?>">
            </div>

            <div class="form__label__md">
                <label>Nom Usager </label>
                <input type="text" name="username" value="<?php echo $row['username']; ?>">

            </div>
           
            <div class="form__label__md">
                <label>Mot de Passe</label>
                <input type="text" name="password" value="<?php echo $row['password']; ?>">

            </div>
            <div class="form__label__md">
                <label>Admin?</label>
                <input type="checkbox" name="admin" <?php if($row['admin']== 1)  echo 'checked="checked"'  ; ?> value="0">
            </div>

            <!-- Modal confirmation modification Usager Catalogue-->
            <div class="confirm__modal__wrapper">
                    <div class="modal__overlay">
                        <div class="modal__contenu ">
                            <h3 class="modal__texte txt_msg-modif"></h3>
                        </div>
                    </div>
                </div>

            <button class="btnModifierUsagerCatalogue">Modifier le profil Usager</button>
            <button class="btn btn-primaire btnAnnul" type="reset">Annuler</button>

        </div>
    </div>
</div>
