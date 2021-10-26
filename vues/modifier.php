
    <div class="form__contenant flex col" vertical layout>

            
       
            
        
            <div class="form__carte">
                <div class="form__image flex">
                <img src="https:<?php echo $row['image'] ?>" alt="">
                </div>
                <form class="form__modif flex col" action="index.php?requete=accueil">
                                <h3 data-id="<?php echo $_POST['id'] ?>"><?php echo $row['nom']; ?></h3>
                                <div class="form__label">
                                    <label>Millesime </label>
                                    <input type="number" name="millesime" value="<?php echo $row['millesime']; ?>">
                                </div>
                                <div class="form__label">
                                    <label>Date achat </label>
                                    <input type="date" name="date_achat" value="<?php echo $row['date_achat']; ?>">
                                </div>
                                <div class="form__label">
                                    <label>Prix </label>
                                  <!-- a tester, prix en text - DK -->
                                    <!-- <input type="text" pattern="[0-9]+([,][0-9]{1,2})?" name="prix" value="<?php echo $row['prix'];  ?>"> -->
                                    <input type="number" step="any"  name="prix" value="<?php echo $row['prix']; ?>">
                                    </div>
                                <div class="form__label">
                                    <label>Garde</label>
                                    <input type="date" name="garde_jusqua" value="<?php echo $row['garde_jusqua']; ?>">
                                </div>
                                <div class="form__label">
                                    <label>Notes </label>
                                <textarea name="notes"><?php echo $row['notes']; ?></textarea>
                                </div>
                                    <button class='btnModifier'>Modifier la bouteille</button>
                
                </form>
            </div>
        </div>
    </div>

