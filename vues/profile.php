
<div class="form__contenant mt-9 flex col" vertical layout>
    <div class="form__carte">
        <div class="form__image flex">
            <h1>Profile</h1>
        </div>
        <?php if (isset($_SESSION['nom'])) {  ?>
            <form class="form__connexion flex col" method="POST" action="index.php?requete=profileConnexion">
                <div class="form__label__connexion">
                    <label>Nom </label>
                    <input type="" name="nom" value="<?php echo $_SESSION['nom']; ?>">
                </div>
                <div class="form__label__connexion">
                    <label>Prenom </label>
                    <input type="" name="prenom" value="<?php echo $_SESSION['prenom']; ?>">
                </div>
                <div class="form__label__connexion">
                    <label>Username </label>
                    <input type="" step="any"  name="username" value="<?php echo $_SESSION['username']; ?>">
                    </div>
                <div class="form__label__connexion">
                    <label>Adresse courriel</label>
                    <input type="" name="email" value="<?php echo $_SESSION['email']; ?>">
                </div>
                    <button class='btnModifier' name="status" value="deconnexion">Deconnexion</button>
            </form>
        <?php }else { ?>
            <form class="form__connexion flex col" method="POST" action="index.php?requete=profileConnexion">
                <div class="form__label__connexion">
                    <label>Adresse courriel</label>
                    <input type="" name="email" value="">
                </div>
                <div class="form__label__connexion">
                    <label>Mot de passe</label>
                    <input type="password" name="password" value="">
                </div>
                    <button class='btnModifier' name="status" value="connexion">Connexion</button>
            </form>
        <?php } ?>
    </div>
</div>