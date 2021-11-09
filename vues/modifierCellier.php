<div class="form__contenant flex col form__contenant--espacevertical" vertical layout>
    <div class="form__carte">
      
        <h3 data-id="" class="nom_bouteille carte__description-nom"></h3>
      
        <div class="form__conteneur">
           
            <div class="form">
                <div class="form__label__aj">
                    <input type="texte" name="nom_cellier" value="<?php echo $dataC['nom_cellier']; ?>" required>
                    <label>Nom du cellier </label>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                </div>
                <button class="btn btn-accent solid " name="btnModifier">Modifier</button>
            </div>
          
            
        </div>
    </div>