<div class="modal__wrapper">
    <div class="modal__overlay">
        <div class="modal__contenu flex col">
            <span class="fermer"><i class="fas fa-times"></i></span>
            <h3 class="modal__texte">Supprimer mon compte?</h3>
            <div class="modal__buttons flex">
                <button class="btn__annuler">Annuler</button>
                <button class="btn__danger">Supprimer</button>
            </div>
        </div>
    </div>
</div>

<section class="light__wrapper">
    <section class="p__profile__wrapper ">
        <div class="form__carte centre">
            <img class="profile__bg__image" src="img/wine_inscription.jpg" alt="">
            <img class="avatar" src="img/abstract-user.svg" alt="">
            <div class="profile__titre__wrapper"><span class="profile__titre"><?php echo $_SESSION['prenom']; echo ' '; echo $_SESSION['nom']; ?></span></div>
            <div>
                <hr>
                <div class="profile__status__wrapper">
                    <p>Statut du profile : <?php if ($_SESSION['admin'] == '1') {
                        ?>Administrateur</p><?php
                    }else{ ?>
                        Utilisateur</p>
                    <?php } ?>
                </div>
                <div class="profile__content__wrapper">
                    <a href="index.php?requete=modifUsager"><button class="profile__btn">Modifier mes informations</button></a>
                    <button class="profile__btn btnSupprimerProfile">Supprimer mon compte</button>
                </div>
            </div>
        </div>
    </section>
</section>