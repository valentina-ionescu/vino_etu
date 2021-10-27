
<?php
	//  require("dataconf.php");
	// require("config.php");
	$type ='vin-blanc';
	$page = 1;
	$nombreProduit = 48; //48 ou 96	
	
	$saq = new SAQ();
	for($i=0; $i<1;$i++)	//permet d'importer séquentiellement plusieurs pages.
	{

		echo "<section class='mt-10 center w-90' >
				<h2 class='txt-blanc'>Page ". ($page+$i)."</h2>";
		$nombre = $saq->getProduits($type, $nombreProduit, $page+$i);

		

		echo "<p class='txt-blanc'>Importation : ". $nombre. " items </p><br> </section>";

	}
			

	
	

?>