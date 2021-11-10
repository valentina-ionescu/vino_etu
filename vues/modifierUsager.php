<div class="form__contenant flex col" vertical layout>
    <div class="form__carte">
    <div class="form__image flex">
            <h1>Mon profile</h1>
        </div>
        <div class="form__modif form__modif__profile flex col">
            <br>
            <div class="form__label__md">
                <input type="texte" name="prenom" value="<?php echo $_SESSION['prenom']; ?>">
                <label>Prenom </label>
            </div>
            <div class="form__label__md">
                <input type="texte" name="nom" value="<?php echo $_SESSION['nom']; ?>">
                <label>Nom </label>
            </div>
            <div class="form__label__md">
                <input type="texte" name="email" value="<?php echo $_SESSION['email']; ?>">
                <label>Email </label>
            </div>
            <div class="form__label__md">
                <input type="texte" name="username" value="<?php echo $_SESSION['username']; ?>">
                <label>Nom d'utilisateur </label>
            </div>
            <div class="form__label__md">
                <input type="password" name="password" value="<?php echo $_SESSION['password']; ?>">
                <label>Mot de passe </label>
            </div>
            <button class="btnModifierUser">Modifier les informations</button>
        </div>
    </div>
</div>
</div>