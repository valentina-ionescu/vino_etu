
<?php
	require_once("dataconf.php");
	require_once("config.php");
	 include("vues/entete_admin.php");

	$page = 30;
	$nombreProduit = 96; //48 ou 96	

	$saq = new SAQ();

	echo "<section class='center w-70' >
	<h2 class=''>Importation Finie  !</h2>";

	for($i=0; $i<$page;$i++)	//permet d'importer séquentiellement plusieurs pages.
	{


		$nombre = $saq->getProduits($nombreProduit, $page+$i);

		$i++;
	}

		
	echo "<p class=''>Importation : ". $nombre. " items </p><br> </section>";
	// include("vues/admin_dashboard.php");
		

?>
