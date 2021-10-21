<div class="modifier">
    <div class="modifBouteille" vertical layout>

            <form action="index.php?requete=accueil">
                <div>
                    <h1 data-id="<?php echo $_POST['id'] ?>"><?php echo $row['nom']; ?></h1>
                    <p>Millesime : <input type="number" name="millesime" value="<?php echo $row['millesime']; ?>"></p>
                    <p>Date achat : <input type="date" name="date_achat" value="<?php echo $row['date_achat']; ?>"></p>
                    <p>Prix : <input type="number" step=".01" name="prix" value="<?php echo $row['prix']; ?>"></p>
                    <p>Garde : <input type="date" name="garde_jusqua" value="<?php echo $row['garde_jusqua']; ?>"></p>
                    <p>Notes <textarea name="notes"><?php echo $row['notes']; ?></textarea></p>
                </div>
                <button class='btnModifier'>Modifier la bouteille</button>
            </form>
        </div>
    </div>
</div>
