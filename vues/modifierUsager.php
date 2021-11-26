<div class="form__contenant mt-3 flex col" vertical layout>
    <div class="form__carte">
    <div class="form__image flex">
            <h1>Mon profile</h1>
        </div>
        <div class="form__modif form__modif__profile flex col">
            <br>
            <div class="form__label__md">
                <label>
                    <input data-js-champ-inscription type="texte" name="prenom" value="<?php echo $_SESSION['prenom']; ?>">
                    Prenom
                </label>
            </div>
            <div class="form__label__md">
                <label>
                    <input data-js-champ-inscription type="texte" name="nom" value="<?php echo $_SESSION['nom']; ?>">
                    Nom
                </label>
            </div>
            <div class="form__label__md">
                <label>
                    <input data-js-champ-inscription type="texte" name="email" value="<?php echo $_SESSION['email']; ?>">
                    Adresse courriel
                </label>
            </div>
            <div class="form__label__md">
            <label>    
                    <input data-js-champ-inscription type="password" name="password" value="<?php echo $_SESSION['password']; ?>">
                    Mot de passe
                </label>
            </div>
            <p data-js-msgError class="message__erreur__inscription display__none">Champ(s) incorrect(s)</p>
            <button class="btnModifierUser btn">Modifier les informations</button>
            <form method="POST" action="index.php?requete=paramUsager">
                <button class="btn btn-primaire btnAnnul" >Annuler</button>
            </form>
        </div>
    </div>
</div>
</div>