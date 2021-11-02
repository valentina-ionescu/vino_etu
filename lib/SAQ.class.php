<?php

/**
 * Class MonSQL
 * Classe qui génère ma connection à MySQL à travers un singleton
 *
 *
 * @author Jonathan Martel
 * @version 1.0
 *
 *
 *
 */
class SAQ extends Modele
{

	const DUPLICATION = 'duplication';
	const ERREURDB = 'erreurdb';
	const INSERE = 'Nouvelle bouteille insérée';

	private static $_webpage;
	private static $_status;
	private $stmt;

	public function __construct()
	{
		parent::__construct();
		if (!($this->stmt = $this->_db->prepare("INSERT INTO vino__bouteille(nom, image, code_saq, pays, description, prix_saq, url_saq,  format, vino__type_id ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"))) {
			echo "Echec de la préparation : (" . $mysqli->errno . ") " . $mysqli->error;
		}
	}

	/**
	 * getProduits
	 * @param int $nombre	
	 * @param int $debut
	 */
	public function getProduits( $nombre = 24, $page = 1 )
	{
		$s = curl_init();
		// $url = "https://www.saq.com/fr/produits/vin/vin-blanc?p=2&product_list_limit=24&product_list_order=name_asc";
		$url="https://www.saq.com/fr/produits/vin?p=2&product_list_limit=24&product_list_order=name_asc";
		
		//curl_setopt($s, CURLOPT_URL, "http://www.saq.com/webapp/wcs/stores/servlet/SearchDisplay?searchType=&orderBy=&categoryIdentifier=06&showOnly=product&langId=-2&beginIndex=".$debut."&tri=&metaData=YWRpX2YxOjA8TVRAU1A%2BYWRpX2Y5OjE%3D&pageSize=". $nombre ."&catalogId=50000&searchTerm=*&sensTri=&pageView=&facet=&categoryId=39919&storeId=20002");
		//curl_setopt($s, CURLOPT_URL, "https://www.saq.com/webapp/wcs/stores/servlet/SearchDisplay?categoryIdentifier=06&showOnly=product&langId=-2&beginIndex=" . $debut . "&pageSize=" . $nombre . "&catalogId=50000&searchTerm=*&categoryId=39919&storeId=20002");
		//curl_setopt($s, CURLOPT_URL, $url);
		//curl_setopt($s, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($s, CURLOPT_CUSTOMREQUEST, 'GET');
		//curl_setopt($s, CURLOPT_NOBODY, false);
		//curl_setopt($s, CURLOPT_FOLLOWLOCATION, 1);

		// Se prendre pour un navigateur pour berner le serveur de la saq...
		curl_setopt_array($s, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0',
			CURLOPT_ENCODING => 'gzip, deflate',
			CURLOPT_HTTPHEADER => array(
				'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
				'Accept-Language: en-US,en;q=0.5',
				'Accept-Encoding: gzip, deflate',
				'Connection: keep-alive',
				'Upgrade-Insecure-Requests: 1',
			),
		));

		self::$_webpage = curl_exec($s);
		self::$_status = curl_getinfo($s, CURLINFO_HTTP_CODE);
		curl_close($s);
		
		$doc = new DOMDocument();
		$doc->recover = true;
		$doc->strictErrorChecking = false;
		@$doc->loadHTML(self::$_webpage);
		$elements = $doc->getElementsByTagName("li");
		$i = 0;
		
		// $data['page_title'] = 'Importation || Bouteilles';
		 $msg = [];
		$data = [];
		foreach ($elements as $key => $noeud) {
			
			//var_dump($noeud -> getAttribute('class')) ;
			//if ("resultats_product" == str$noeud -> getAttribute('class')) {

			if (strpos($noeud->getAttribute('class'), "product-item") !== false) {
			
				//echo $this->get_inner_html($noeud);

				$info = self::recupereInfo($noeud);
				//echo "<p>".$info->nom;
				$retour = $this -> ajouteProduit($info);
			//	echo "<br>Code de retour : " . $retour -> raison . "<br>";
				
			 
				
				  // echo "<br>Code de retour : " . $retour->raison . "<br>";


				if ($retour->succes == false) {
				//	echo "<pre>";
					//var_dump($info);
					$msg="erreur d'importation";
				//	echo "</pre>";
				//	echo "<br>";
				} else {
					$i++;
				}
				// echo "</p>";

				 array_push($data,['info'=>$info, "retour"=>$retour, "msg"=>$msg, 'i'=> $i++  ] );// creer un array de donnees pour afficher sur la page. 
			}
			
		} 
		
	RequirePage::getView('importation', $data);
		
		return $i;
	}

	private function get_inner_html($node)
	{
		$innerHTML = '';
		$children = $node->childNodes;
		foreach ($children as $child) {
			$innerHTML .= $child->ownerDocument->saveXML($child);
		}

		return $innerHTML;
	}
	private function nettoyerEspace($chaine)
	{
		return preg_replace('/\s+/', ' ', $chaine);
	}
	private function recupereInfo($noeud)
	{

		$info = new stdClass();

		// $info->img = $noeud->getElementsByTagName("img")->item(0)->getAttribute('src'); // ancien code n'est pas optimal car importe  la premiere balise "img" qu'il rencontre, et parfois ce n'est pas l'image de la bouteille de vin -- c'est un medaillon ou meme de petites icones.

		 $imgs = $noeud->getElementsByTagName("img");

		
//chercher la balise qui contient l'image du produit en ciblant la classe

		 for($i=0;$i<$imgs->length;$i++) {
			if($imgs->item($i)->attributes->getNamedItem('class')){
				if($imgs->item($i)->attributes->getNamedItem('class')->nodeValue == "product-image-photo") {
					//recuperer l'url image
					$info->img=	$imgs->item($i)->getAttribute('src');
				}
			}
		}



		$a_titre = $noeud->getElementsByTagName("a")->item(0);
		$info->url = $a_titre->getAttribute('href');

		//var_dump($noeud -> getElementsByTagName("a")->item(1)->textContent);
		$nom = $noeud->getElementsByTagName("a")->item(1)->textContent;
		//var_dump($a_titre);
		$info->nom = self::nettoyerEspace(trim($nom));
		//var_dump($info -> nom);
		// Type, format et pays
		$aElements = $noeud->getElementsByTagName("strong");
		foreach ($aElements as $node) {
			if ($node->getAttribute('class') == 'product product-item-identity-format') {
				$info->desc = new stdClass();
				$info->desc->texte = $node->textContent;
				$info->desc->texte = self::nettoyerEspace($info->desc->texte);
				$aDesc = explode("|", $info->desc->texte); // Type, Format, Pays
				if (count($aDesc) == 3) {

					$info->desc->type = trim($aDesc[0]);
					$info->desc->format = trim($aDesc[1]);
					$info->desc->pays = trim($aDesc[2]);
				}

				$info->desc->texte = trim($info->desc->texte);
			}
		}

		//Code SAQ
		$aElements = $noeud->getElementsByTagName("div");
		foreach ($aElements as $node) {
			if ($node->getAttribute('class') == 'saq-code') {
				if (preg_match("/\d+/", $node->textContent, $aRes)) {
					$info->desc->code_SAQ = trim($aRes[0]);
				}
			}
		}

		$aElements = $noeud->getElementsByTagName("span");
		foreach ($aElements as $node) {
			if ($node->getAttribute('class') == 'price') {
				$info->prix = trim($node->textContent); //valeur "1,23 $"

				/******     Code a conserver si on decide de manipuler le prix pour des calculs   *******/

				// convertir la "," en "." pour conserver les decimales
				//$info -> prix = str_replace('$', '', $info -> prix); //valeur "1.23 $"

				// enlever tout exceptee les chifres et le ","
					$info -> prix = preg_replace("/[^0-9\,]/", "", $info -> prix); //valeur "1.23"

				//transformer la chaine de caracteres en float pour envoyer a la DB 
				//$info -> prix = floatval($info -> prix); //valeur 1.23


			}
		}

		// var_dump($info);
		return $info;
	}

	private function ajouteProduit($bte)
	{
		$retour = new stdClass();
		$retour->succes = false;
		$retour->raison = '';

		// print_r($bte);
		// Récupère le type
		$rows = $this->_db->query("select id from vino__type where type = '" . $bte->desc->type . "'");

		if ($rows->num_rows == 1) {
			$type = $rows->fetch_assoc();
			//var_dump($type);
			$type = $type['id'];

			$rows = $this->_db->query("select id from vino__bouteille where code_saq = '" . $bte->desc->code_SAQ . "'");
			// echo $bte->desc->code_SAQ;
			if ($rows->num_rows < 1) {

				/*  la decision de garder le data-type a "s" pour le prix importee de la page SAQ est pour faciliter l'affichage du prix dans le meme format sur la page de notre application. Au besoin ce data-type poura etre change pour 'd', apres avoir transformee la donnee resu de "chaine de caracteres" en float, ou int */

				$this->stmt->bind_param("ssssssssi", $bte->nom, $bte->img, $bte->desc->code_SAQ, $bte->desc->pays, $bte->desc->texte, $bte->prix, $bte->url, $bte->desc->format, $type);
				$retour->succes = $this->stmt->execute();
				$retour->raison = self::INSERE;
				// var_dump($this->stmt);

			} else {
				$retour->succes = false;
				$retour->raison = self::DUPLICATION;
			}
		} else {
			$retour->succes = false;
			$retour->raison = self::ERREURDB;
		}
		
		
		return $retour;
		

	}
}
