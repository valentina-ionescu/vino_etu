<section class="u__profile__wrapper">
<div class="u__menu">
   
  
    <form method="POST" action="index.php?requete=profileConnexion">
    <!-- <button name="status" value="deconnexion">Deconnexion</button> -->
    </form>

    
</div>


<h3 class="u__titre">Gestion des Celliers</h3>
<p>Mes celliers</p>
<div class="u__celliers_liste flex col">
<?php foreach ($dataC as $cle => $cel) { ?>
    <article class="u__article flex col">
       <button class="selectCellier" data-cellid="<?php echo $cel['id'] ?>"><?php echo $cel['nom_cellier'] ?></button> 
    </article> <?php }?>
    <form method="POST" action="index.php?requete=ajouterCellier">
        <button class="u__ajout">Ajouter</button>
    </form>
 
</div>
</section>