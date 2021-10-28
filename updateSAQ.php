
<?php
	require_once("dataconf.php");
	require_once("config.php");
	include("vues/entete.php");

	$page = 1;
	$nombreProduit = 24; //48 ou 96	
	
	$saq = new SAQ();
	for($i=0; $i<1;$i++)	//permet d'importer séquentiellement plusieurs pages.
	{
		echo "<section class='mt-10 center w-70' >
		<h2 class='txt-blanc'>Page ". ($page+$i)."</h2>";


		$nombre = $saq->getProduits($nombreProduit,$page+$i);

		echo "<p class='txt-blanc'>Importation : ". $nombre. " items </p><br> </section>";
	
	}
		

?>
