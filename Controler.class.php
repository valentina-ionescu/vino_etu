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
				/*case 'ajouterBouteilleNonListee':
					$this->ajouterBouteilleNonListee();
					break;*/
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
			case 'paramUsager':
				$this->paramUser();
				break;
			case 'creationUsager':
				$this->addUser();
				break;
			case 'suppUsager':
				$this->delUser();
				break;
			case 'modifUsager':
				$this->modifUser();
				break;
			case 'profile':
				$this->afficherProfile();
				break;
			case 'admin':
				$this->afficherAdmin();
				break;
			case 'desactiverBouteilleCatalogue':
				$this->supprimerBouteilleCatalogue();
				break;
			case 'modifierBouteilleCatalogue':
				$this->modifierBouteilleCatalogue();
				break;
			case 'profileConnexion':
				$this->gestionConnexion();
				break;
			case 'getCellier':
				$this->getCellier();
				break;
			case 'getCatalogue':
				$this->getCatalogue();
				break;
			case 'supprimerUsagerCatalogue':
				$this->supprimerUsagerCatalogue();
				break;
			case 'modifierUsagerCatalogue':
				$this->modifierUsagerCatalogue();
				break;
			case 'ajouterBouteilleNonListeeCatalogue':
				$this->ajouterBouteilleCatalogue();
				break;
			case 'formAjouterBouteilleNonListee':
				$this->formAjouterBouteilleNonListee();
				break;
			case 'listeCelliers':
				$this->listeCelliers();
				break;
			case 'ajouterCellier':
				$this->addCellier();
				break;
			case 'editCellier':
				$this->editCellier();
				break;
			case 'modifierCellier':
				$this->modifierCellier();
				break;
			case 'suppCellier':
				$this->suppCellier();
				break;
			case 'home':
				$this->home();
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
		$msg = '';
		if (isset($_SESSION['usager_id'])) {
			$dataC = $cel->getCellierInfo();

			if (isset($_SESSION['cellier_id'])) {
				$msg = "";
	
				$bte = new Bouteille();

				$dataB = $bte->getListeBouteilleCellier();
				
			
				if(empty($dataB)) //pas de bouteilles dans le cellier
				$msg = "Votre cellier est vide.";

				include("vues/entete.php");
				include("vues/cellier.php");
				include("vues/pied.php");
			}else {
				
				include("vues/entete.php");
				include("vues/upanneau.php");
				include("vues/pied.php");
			}	
		} else {
			include("vues/entete.php");
			include("vues/profile.php");
			include("vues/pied.php");
		}
		

	}

	private function home() {
		$User = new Usager();
		$cel = new Cellier();
		$msg = '';
		if (isset($_SESSION['usager_id'])) {
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

	private function afficherProfile()
	{
		$User = new Usager();
		if (isset($_SESSION['nom'])) {
			$cel = new Cellier();
			$dataC = $cel->getCellierInfo();

			include("vues/entete.php");
			include("vues/upanneau.php");
			include("vues/pied.php");
		} else {
			include("vues/entete.php");
			include("vues/profile.php");
			include("vues/pied.php");
		}
	}

	private function addUser()
	{
		$body = json_decode(file_get_contents('php://input'));

		if (!empty($body)) {

			$user = new Usager();

			$hashPass = $user->hashPassword($body->password);
			$user->inscription($body, $hashPass);

			
		} else {
			include("vues/entete.php");
			include("vues/inscription.php");
			include("vues/pied.php");
		}
	}

	private function addCellier()
	{
		$body = json_decode(file_get_contents('php://input'));
        $err_msg = "";

		if (!empty($body)) {

			#var_dump($body);
			#echo $body->nom;

			$cel = new Cellier();

			$NouveauNomCel = $body->nom;
			// Validation du nom de cellier non vide
			if (empty($NouveauNomCel)) {
				$err_msg = "Le nom de cellier ne doit pas être vide.";
				echo json_encode($err_msg);
			}else {
				$resultat = $cel->ajouterCellier($NouveauNomCel);
				echo json_encode("");
			}

			// echo $NouveauNomCel;
			
		}
		// } else {
		// 	include("vues/entete.php");
		// 	include("vues/ajouterCellier.php");
		// 	include("vues/pied.php");
		// }
	}
	private function delUser()
	{

		$id = $_SESSION['usager_id'];
		
		$user = new Usager();
		
		$user->supprimerUsager($id);

		echo $_SESSION['usager_id'];
		
		session_destroy();

		header('Location: index.php?');
	}

	private function modifUser()
	{
		$body = json_decode(file_get_contents('php://input'));

		if(!empty($body)){

			$User = new Usager();
			$id = $_SESSION['usager_id'];
			$resultat = $User->modifierUsager($body, $id);
		}
		else{
			include("vues/entete.php");
			include("vues/modifierUsager.php");
			include("vues/pied.php");
		}
	}

	private function paramUser()
	{
		include("vues/entete.php");
		include("vues/param_usager.php");
		include("vues/pied.php");
	}
	
	/**
	 * getCellier retourne l'information sur un cellier donné
	 *
	 * @return void
	 */
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
		$celNom = $cel->getCellierNom($_SESSION['cellier_id']);
		$_SESSION['cellier_nom'] = $celNom['nom_cellier'];
	}


	/**
	 * editCellier Permet de modifier le nom d'un cellier
	 *
	 * @param  mixed $id
	 * @return void
	 */
	private function editCellier()
	{
		$body = json_decode(file_get_contents('php://input'));
		$id = $_POST['id'];

		if (!empty($body)) {

			$cel = new Cellier();
			$resultat = $cel->modifierCellier($body);

			echo json_encode($resultat);
		} else {
			$cel = new Cellier();
			$dataC = $cel->getCellierNom($id);
			include("vues/entete.php");
			include("vues/modifierCellier.php");
			include("vues/pied.php");
		}
	}

	private function modifierCellier()
	{

		$id = $_POST['id'];
		$nom_cellier = $_POST['nom_cellier'];

		$cel = new Cellier();



		$resultat = $cel->modifierCellier($nom_cellier, $id);

		include("vues/entete.php");
		include("vues/modifierCellier.php");
		include("vues/pied.php");
	}
	


	private function gestionConnexion()
	{
		$User = new Usager();
    //  if(isset($_POST['status'])) {
		if ($_POST['status'] == 'deconnexion') {

			$User->deconnexion();

			header('Location: index.php?requete=profile');
		} elseif ($_POST['status'] == 'connexion') {

			$Pass = $_POST['password'];

			$cel = new Cellier();
			$_SESSION['password'] = $Pass;

			$validation = $User->checkPassword($Pass, $_POST['email']);

			// echo $validation;

			if ($validation) {

				$connect = $User->connexion();
				$dataC = $cel->getCellierInfo();
				if($_SESSION['admin']==1){
					header('Location: index.php?requete=admin');
				}
				include("vues/entete.php");
				include("vues/upanneau.php");
				include("vues/pied.php");

				// header('Location: index.php?requete=profile');
			} else {
				header('Location: index.php?requete=creationUsager');
			}
		}
	// }
	}


	private function getCatalogue()
	{
		$user = new Usager();
		$listeUsager = $user->getListeUsager();

		$bte = new Bouteille();
		$listeBouteilles = $bte->getListeBouteille();
		// var_dump($listeBouteilles);
		$_SESSION['listeBouteilles'] = $listeBouteilles;

		// echo json_encode($listeBouteilles);
		include("vues/admin_controls.php");
	}


	private function listeBouteille()
	{
		$bte = new Bouteille();
		$cellier = $bte->getListeBouteilleCellier();
		var_dump($cellier);
		echo json_encode($cellier);
		//  include("vues/accueil.php");       
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
		if (!empty($body)) {
			$bte = new Bouteille();
			// var_dump($_POST['data']);

			//var_dump($data);
			$resultat = $bte->ajouterBouteilleCellier($body);
			echo json_encode($resultat);
		} else {
			include("vues/entete.php");
			include("vues/ajouter.php");
			include("vues/pied.php");
		}
	}

	private function modifierBouteilleCellier()
	{
		$body = json_decode(file_get_contents('php://input'));


		$idBouteille = $_POST['id'];

		if (!empty($body)) {

			$bte = new Bouteille();
			var_dump($_POST['data']);

			$id = $body->id;

			$resultat = $bte->modifierBouteilleCellier($body, $id);

			echo json_encode($resultat);
		} else {
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
	private function supprimerBouteilleCellier()
	{
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

	private function updateSAQ()
	{
		$saq = new SAQ;
		require_once('updateSAQ.php');
	}

	/**
	 * afficherAdmin
	 *
	 * @return void
	 */


	private function afficherAdmin()
	{
		if($_SESSION['admin']==1){
		$msg = '';
		$saq = new SAQ();
		$bte = new Bouteille();
		$listeBouteilles = $bte->getListeBouteille();


		$user = new Usager();
		$listeUsager = $user->getListeUsager();
		//  var_dump($listeUsager);
		$_SESSION['listeUsagers'] = $listeUsager;
		$_SESSION['listeBouteilles'] = $listeBouteilles;



		// echo json_encode($listeBouteilles);
		include("vues/admin_controls.php");
	}else{
		$ctrl = new Controler;
		$ctrl->accueil();

	}
	}


	/**
	 * supprimerBouteilleCatalogue
	 *
	 * @return void
	 */

	private function supprimerBouteilleCatalogue() // desactiver la bouteille au lieu de la supprimer
	{
		$body = json_decode(file_get_contents('php://input'));
		$idBouteille = $body->id;

		$bte = new Bouteille();
		$listeBouteilles = $bte->getListeBouteille();
		$user = new Usager();
		$listeUsager = $user->getListeUsager();
		$msg = "La bouteille no." . $idBouteille . " a été supprimée avec succès!";
		
		$bte->supprimerBouteilleCatalogue($idBouteille);
		$controller = new Controler;
	


	}


	/**
	 * modifierBouteilleCatalogue
	 *
	 * @return void
	 */

	private function modifierBouteilleCatalogue()
	{
		$body = json_decode(file_get_contents('php://input'));


		$idBouteille = $_POST['id'];
	

		if (!empty($body)) {

			$bte = new Bouteille();

			$id = $body->id;

			$resultat = $bte->modifierBouteilleCatalogue($body, $id);


			echo json_encode($resultat);
		} else {

			$bte = new Bouteille();
			$resultat = $bte->getBouteilleById($idBouteille);
			$row = $resultat->fetch_assoc();
			include("vues/entete_admin.php");

			include("vues/admin_modifierBouteille.php");
		}
	}


	/**
	 * supprimerUsagerCatalogue
	 *
	 * @return void
	 */
	

	private function supprimerUsagerCatalogue()
	{	

		$body = json_decode(file_get_contents('php://input'));
		$id = $body->id;



		$user = new Usager();

		$user->supprimerUsager($id);


	}


	/**
	 * modifierUsagerCatalogue
	 *
	 * @return void
	 */

	private function modifierUsagerCatalogue()
	{
		$body = json_decode(file_get_contents('php://input'));


		$idUsg = $_POST['id'];
	

		if (!empty($body)) {

			$usg = new Usager();
			var_dump($_POST['data']);

			$id = $body->id;

			$resultat = $usg->modifierUsagerCatalogue($body, $idUsg);


			echo json_encode($resultat);
		} else {

			$usg = new Usager();
			$resultat = $usg->getUsagerById($idUsg);
			$row = $resultat->fetch_assoc();

			include("vues/entete_admin.php");

			include("vues/admin_modifierUsager.php");
		}
	}

	/**
	 * suppCellier
	 *
	 * @return void
	 */

	private function suppCellier()
	{
		$body = json_decode(file_get_contents('php://input'));

		$cel = new Cellier();
		$id = $body->id;
		$cel->supprimerCellier($id);
	}

	private function formAjouterBouteilleNonListee()
	{
		include("vues/entete.php");
		include("vues/ajouter_nonListees.php");
	}


	/**
	 * ajouterBouteilleCatalogue
	 *
	 * @return void
	 */


	private function ajouterBouteilleCatalogue() // en developpement!!!
	{

		$body = json_decode(file_get_contents('php://input'));
	

		if (!empty($body)) {

			var_dump($_POST);

			$bte = new Bouteille();

			var_dump($_POST['data']);

			$id = $body->id;

			$resultat = $bte->ajouterBouteilleNonListee($body);


			echo json_encode($resultat);
		} else {



			include("vues/ajouter_nonListees.php");

		}


	}
	
	/**
	 * listeCelliers
	 *
	 * @return $dataC
	 */
	private function listeCelliers() {
		// $order = json_decode(file_get_contents('php://input'));
		$order = $_GET['order'];
		// $User = new Usager();
		$cel = new Cellier();
		$msg = '';
		if (isset($_SESSION['usager_id'])) {
			$dataC = $cel->getListeCellier($order);
		
			echo json_encode($dataC);
		}else {
			include("vues/entete.php");
			include("vues/profile.php");
			include("vues/pied.php");
		}
		
	}
}
