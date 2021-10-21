<div class="modifier">
    <div class="modifBouteille" vertical layout>

            <form action="index.php?requete=accueil">
                <div>
                    <h1 data-id="<?php echo $_POST['id'] ?>"><?php echo $id = $_POST['id'] ?></h1>
                    <p>Millesime : <input name="millesime"></p>
                    <p>Date achat : <input name="date_achat"></p>
                    <p>Prix : <input name="prix"></p>
                    <p>Garde : <input name="garde_jusqua"></p>
                    <p>Notes <input name="notes"></p>
                </div>
                <button class='btnModifier'>Modifier la bouteille</button>
            </form>
        </div>
    </div>
</div>
