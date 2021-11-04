
<?php
	require_once("dataconf.php");
	require_once("config.php");
	 include("vues/entete_admin.php");

	$page = 1;
	$nombreProduit = 24; //48 ou 96	

	$saq = new SAQ();

	for($i=0; $i<1;$i++)	//permet d'importer séquentiellement plusieurs pages.
	{
		echo "<section class='mt-10 center w-70' >
		<h2 class=''>Page ". ($page+$i)."</h2>";


		$nombre = $saq->getProduits($nombreProduit, $page+$i);

		echo "<p class=''>Importation : ". $nombre. " items </p><br> </section>";
	
	}
	// include("vues/admin_dashboard.php");
		

?>
