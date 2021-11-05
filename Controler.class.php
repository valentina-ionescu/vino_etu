<?php

session_start();

/**
 * Class Controler
 * Gère les requêtes HTTP
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */

class Controler 
{
	
		/**
		 * Traite la requête
		 * @return void
		 */
		public function gerer()
		{
			
			switch ($_GET['requete']) {
				case 'listeBouteille':
					$this->listeBouteille();
					break;
				case 'autocompleteBouteille':
					$this->autocompleteBouteille();
					break;
				case 'ajouterNouvelleBouteilleCellier':
					$this->ajouterNouvelleBouteilleCellier();
					break;
				case 'ajouterBouteilleCellier':
					$this->ajouterBouteilleCellier();
					break;
				case 'boireBouteilleCellier':
					$this->boireBouteilleCellier();
					break;
				case 'modifierBouteilleCellier':
					$this->modifierBouteilleCellier();
					break; 
				case 'supprimerBouteilleCellier':
					$this->supprimerBouteilleCellier();
					break; 
				case 'updateSAQ':
				 		$this->updateSAQ();
				 		break; 
				case 'profile':
					$this->afficherProfile();
					break;
				case 'profileConnexion':
					$this->gestionConnexion();
					break;
				case 'getCellier':
					$this->getCellier();
					break;
				case 'ajouterCellier':
					$this->addCellier();
					break;
				default:
					$this->accueil();
					break;
			}
		}

		private function accueil()
		{
			$User = new Usager();
			$cel = new Cellier();

			if (isset($_SESSION['usager_id'])) {
				$dataC = $cel->getCellierInfo();
			}else {
				include("vues/entete.php");
				include("vues/profile.php");
				include("vues/pied.php");
			}

			if (isset($_SESSION['cellier_id'])) {

				$bte = new Bouteille();
				
				$dataB = $bte->getListeBouteilleCellier();
			}

			include("vues/entete.php");
			include("vues/cellier.php");
			include("vues/pied.php");
		}

		private function afficherProfile()
		{
			$User = new Usager();
			if (isset($_SESSION['nom'])) {
				$cel = new Cellier();
				$dataC = $cel->getCellierInfo();
				include("vues/entete.php");
				include("vues/upanneau.php");
				include("vues/pied.php");
			}else {
				include("vues/entete.php");
				include("vues/profile.php");
				include("vues/pied.php");
			}

		}

		private function addCellier()
		{
			$body = json_decode(file_get_contents('php://input'));

			if(!empty($body)){

				#var_dump($body);
				#echo $body->nom;

				$cel = new Cellier();

				$NouveauNomCel = $body->nom;
				
				echo $NouveauNomCel;

				$resultat = $cel->ajouterCellier($NouveauNomCel);
				
				echo json_encode($resultat);
			}else {
				include("vues/entete.php");
				include("vues/ajouterCellier.php");
				include("vues/pied.php");
			}
		}
		
		private function getCellier()
		{
			$cel = new Cellier();
			$bte = new Bouteille();

			$body = json_decode(file_get_contents('php://input'));
			echo $body->id;

			$_SESSION['cellier_id'] = $body->id;

			echo $_SESSION['cellier_id'];

			$dataB = $bte->getListeBouteilleCellier();
			$dataC = $cel->getCellierInfo();
		}

		private function gestionConnexion()
		{
			$User = new Usager();

			if ($_POST['status'] == 'deconnexion') {

				$User->deconnexion();

				header('Location: index.php?requete=profile');

			}elseif ($_POST['status'] == 'connexion') {

				$User->connexion();
                $cel = new Cellier();
				$dataC = $cel->getCellierInfo();
				// header('Location: index.php?requete=profile');
				include("vues/entete.php");
				include("vues/upanneau.php");
				include("vues/pied.php");

			}
		}

		
		private function listeBouteille()
		{
			$bte = new Bouteille();
            $cellier = $bte->getListeBouteilleCellier();
            
            echo json_encode($cellier);
			include("vues/accueil.php");       
		}
		
		private function autocompleteBouteille()
		{
			$bte = new Bouteille();
			//var_dump(file_get_contents('php://input'));
			$body = json_decode(file_get_contents('php://input'));
			//var_dump($body);
            $listeBouteille = $bte->autocomplete($body->nom);
            
            echo json_encode($listeBouteille);
                  
		}
		private function ajouterNouvelleBouteilleCellier()
		{
			$body = json_decode(file_get_contents('php://input'));
			// var_dump($body);
			if(!empty($body)){
				$bte = new Bouteille();
				// var_dump($_POST['data']);
				
				//var_dump($data);
				$resultat = $bte->ajouterBouteilleCellier($body);
				echo json_encode($resultat);
			}
			else{
				include("vues/entete.php");
				include("vues/ajouter.php");
				include("vues/pied.php");
			}
		}

		private function modifierBouteilleCellier()
		{
			$body = json_decode(file_get_contents('php://input'));
			

			$idBouteille = $_POST['id'];

			if(!empty($body)){

				$bte = new Bouteille();
				  var_dump($_POST['data']);

				$id = $body->id;
				
				$resultat = $bte->modifierBouteilleCellier($body, $id);

				echo json_encode($resultat);
			}
			else{
				$bte = new Bouteille();
				$resultat = $bte->getInfoBouteille($idBouteille);
				$row = $resultat->fetch_assoc();
				include("vues/entete.php");
				include("vues/modifier.php");
				include("vues/pied.php");
			}
		}

				
		/**
		 * supprimerBouteilleCellier
		 *
		 * @return void
		 */
		private function supprimerBouteilleCellier() {
			$body = json_decode(file_get_contents('php://input'));
			$idBouteille = $_POST['id'];
			$bte = new Bouteille();
			$id = $body->id;
			$bte->supprimerBouteilleCellier($id);
		}
		
		private function boireBouteilleCellier()
		{
			$body = json_decode(file_get_contents('php://input'));
			
			$bte = new Bouteille();
			$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, -1);
			echo json_encode($resultat);
		}

		private function ajouterBouteilleCellier()
		{
			$body = json_decode(file_get_contents('php://input'));
			
			$bte = new Bouteille();
			$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, 1);
			echo json_encode($resultat);
		}

		 private function updateSAQ (){
		 	$saq = new SAQ;
			require_once('updateSAQ.php');
		 }

		 
}
?>















