
<div class="form__contenant mt-9 flex col" vertical layout>
    <div class="form__carte">
        <div class="form__image flex">
            <h1>Se connecter</h1>
        </div>
        <form class="form__connexion flex col" method="POST" action="index.php?requete=profileConnexion">
            <div class="form__label__connexion">
                <label>Adresse courriel</label>
                <input type="" name="email" value="">
            </div>
            <div class="form__label__connexion">
                <label>Mot de passe</label>
                <input type="password" name="password" value="">
            </div>
            <a href="index.php?requete=creationUsager">Se créer un compte</a>
                <button class='btnModifier' name="status" value="connexion">Connexion</button>
        </form>
    </div>
</div>