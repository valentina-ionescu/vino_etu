<div class="form__contenant mt-9 flex col" vertical layout>
    <div class="form__carte">
        <div class="form__image flex">
            <h1>Inscription</h1>
        </div>
        <div class="form__connexion flex col" method="POST">   
            <div class="form__label__connexion">
                <label>Nom
                <input data-js-champ-inscription type="" name="nomUser" required value="">
                </label>
            </div>
            <div class="form__label__connexion">
                <label>Prenom
                <input data-js-champ-inscription type="" name="prenomUser" required value="">
                </label>
            </div>
            <div class="form__label__connexion">
                <label>Adresse courriel
                <input data-js-champ-inscription type="email" name="emailUser" required value="">
                </label>
            </div>
            <div class="form__label__connexion">
                <label>Mot de passe
                <input data-js-champ-inscription type="password" name="passwordUser" required value="">
                </label>
            </div>
            <!-- Modal confirmation modification bouteille Catalogue-->
            <div class="confirm__modal__wrapper">
                                <div class="modal__overlay">
                        <div class="modal__contenu ">
                            <h3 class="modal__texte txt_msg-modif"></h3>
                        </div>
                    </div>
                </div>

            <p data-js-msgError class="message__erreur__inscription display__none">Champ incorrect</p>
            <button class='btnModifier' name="ajouterUser" value="inscription">S'inscrire</button>


        </div>
    </div>
</div>