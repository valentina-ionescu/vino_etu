
<?php
	require_once("dataconf.php");
	require_once("config.php");
	 include("vues/entete_admin.php");

	$page = 1;
	$nombreProduit = 96; //48 ou 96	

	$saq = new SAQ();

	$nbrBT = $saq->NombrePagesSaq();

	$nbrBTF = ceil($nbrBT/96);

echo "<section class='center w-70' >
		<h2 class=''>Importation Finie  !</h2>";

	for($i=0; $i<$nbrBTF;$i++)	//permet d'importer séquentiellement plusieurs pages.
	{
		


		$nombre = $saq->getProduits($nombreProduit, $page+$i);

		$i++;

		 
	}



	
	echo "<p class=''>Importation : ". $nombre. " items </p><br> </section>";
	#include("vues/admin_dashboard.php");
		

?>
