<div class="form__contenant flex col" vertical layout>
    <div class="form__carte">
        <div class="form__image flex">
            <img src="<?php echo $row['image'] ?>" alt="">
        </div>
        <div class="form__modif flex col">
            <h3 data-id="<?php echo $_POST['id'] ?>"><?php echo $row['nom']; ?></h3>
            <div class="form__label__md">
                <input type="number" name="millesime" value="<?php echo $row['millesime']; ?>">
                <label>Millesime </label>
            </div>
            <div class="form__label__md">
                <input type="date" name="date_achat" value="<?php echo $row['date_achat']; ?>">
                <label>Date achat </label>
            </div>
            <div class="form__label__md">
                <input type="text" name="prix" value="<?php echo $row['prix']; ?>">
                <label>Prix </label>
            </div>
            <div class="form__label__md">
                <input type="text" name="garde_jusqua" value="<?php echo $row['garde_jusqua']; ?>">
                <label>Garde</label>
            </div>
            <div class="form__label__md">
                <label>Notes </label>
                <textarea rows="5" name="notes"><?php echo $row['notes']; ?></textarea>
            </div>
            <button class="btnModifier">Modifier la bouteille</button>
            <form method="POST" action="index.php?requete=accueil">
                <button class="btn btn-primaire btnAnnul" >Annuler</button>
            </form>

        </div>
    </div>
</div>
</div>