
<?php
	require_once("dataconf.php");
	require_once("config.php");
	 include("vues/entete_admin.php");

	$saq = new SAQ();
	$nombre = 0;
	$page = 1;
	$nombreProduit = 96; //48 ou 96	
	$nbBtTot = $saq->NombrePagesSaq(); 

	$nbBtPages = $nbBtTot/$nombreProduit;


	 for($i=0; $i<$nbBtPages;$i++)	//permet d'importer séquentiellement plusieurs pages.
	 {
		

	 	 $nombre = $saq->getProduits($nombreProduit, $page+$i);

	 	$i++;

		 
	 }
	

	
  echo "<p class=''>Importation : ". $nombre. " items </p><br> </section>";
		

?>
