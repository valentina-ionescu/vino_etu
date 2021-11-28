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
			case 'ajouterBouteillePerso':
				$this->ajouterBouteillePerso();
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
			case 'getCellierTrie':
				$this->getCellierTrie();
				break;
			case 'getCellierFiltre':
				$this->getCellierFiltre();
				break;
			case 'getListeBouteilles':
				$this->getListeBouteilles();
				break;
			case 'getCatalogue':
				$this->getCatalogue();
				break;
			case 'getUsagersListe':
				$this->getUsagersListe();
				break;
			case 'supprimerUsagerCatalogue':
				$this->supprimerUsagerCatalogue();
				break;
			case 'changerUsagerStatutAdmin':
				$this->changerUsagerStatutAdmin();
				break;
			case 'modifierUsagerCatalogue':
				$this->modifierUsagerCatalogue();
				break;
			case 'ajouterBouteilleNonListeeCatalogue':
				$this->ajouterBouteilleCatalogue();
				break;
			case 'ajouterImageLocal':
				$this->ajouterImageLocal();
				break;
			case 'ajouterImagePerso':
				$this->ajouterImagePerso();
				break;
			case 'formAjouterBouteilleNonListee':
				$this->formAjouterBouteilleNonListee();
				break;
			case 'rechercheBouteilles':
				$this->rechercheBouteilles();
				break;
			case 'getCatalogResultRech':
				$this->getCatalogResultRech();
				break;
			case 'rechercheUsagersCatalogue':
				$this->rechercheUsagersCatalogue();
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


				if (empty($dataB)) //pas de bouteilles dans le cellier
					$msg = "<h3 class='ml txt-blanc'>Votre cellier est vide.</h3>" . "<a class='btn-filtre' href='index.php?requete=ajouterNouvelleBouteilleCellier' class='txt-blanc'>Ajoutez des bouteilles</a>";

				include("vues/entete.php");
				include("vues/cellier.php");
				include("vues/pied.php");
			} else {

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

	private function home()
	{
		$User = new Usager();
		$cel = new Cellier();
		$msg = '';
		if (isset($_SESSION['usager_id'])) {
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
			} else {
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

		if (!empty($body)) {

			$User = new Usager();
			$id = $_SESSION['usager_id'];
			$resultat = $User->modifierUsager($body, $id);
		} else {
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
				if ($_SESSION['admin'] == 1) {
					header('Location: index.php?requete=getCatalogue');
				}
				include("vues/entete.php");
				include("vues/upanneau.php");
				include("vues/pied.php");

				// header('Location: index.php?requete=profile');
			} else {
				$erreurMsg = TRUE;
				include("vues/entete.php");
				include("vues/profile.php");
				include("vues/pied.php");
			}
		}
		// }
	}


	private function getCatalogue()
	{
		if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
			$bte = new Bouteille();
			$user = new Usager();
			$listeUsager = $user->getListeUsager();

			$listeBouteilles = $bte->getListeBouteille();
			// var_dump($listeBouteilles);
			$_SESSION['listeBouteilles'] = $listeBouteilles;

			$body = json_decode(file_get_contents('php://input'));

			// Pagination
			//determine the total number of pages available  




			if (!isset($_GET['page'])) {
				$page = 1;
			} else {
				$page = $_GET['page'];
			}

			$bdR = json_decode(file_get_contents('php://input'));


			//  var_dump ($body);
			//  if (isset($_GET['Recherche'])) {
			if (isset($_GET['rech'])) {
				// var_dump($_GET['rech']);



				$requete  = 'SELECT * FROM vino__bouteille WHERE nom LIKE "%' . $_GET['rech'] . '%"  AND statut_desactive !=1 OR statut_desactive is NULL';


				$resultatRecherche = $bte->rechercheBouteillesCatalogue($_GET['rech']);

				$number_of_result = count($resultatRecherche);
				$resultats_par_page = 30;
				$urlPage = 'index.php?requete=getCatalogue&rech=' . $_GET['rech'] . '&page=';
			} else {
				$requete  = "Select * From vino__bouteille";

				$number_of_result = $bte->getNumRowsBouteilles($requete);
				$resultats_par_page = 30;
				$urlPage= 'index.php?requete=getCatalogue&page=';
			}

			$urlPage = $urlPage;
			$number_of_page = ceil($number_of_result / $resultats_par_page);

			$resultatPage = $bte->pagination($resultats_par_page, $page,  $number_of_result, $requete);



			include("vues/admin_entetePrincipale.php");
			include("vues/admin_listeBouteilles.php");
			include("vues/admin_pied.php");
		} else {
			$ctrl = new Controler;
			$ctrl->accueil();
		}
	}


	private function getUsagersListe()
	{
		$user = new Usager();
		$listeUsager = $user->getListeUsager();

		// $bte = new Bouteille();
		// $listeBouteilles = $bte->getListeBouteille();
		// // var_dump($listeBouteilles);
		$_SESSION['listeUsager'] = $listeUsager;

		include("vues/admin_entetePrincipale.php");
		include("vues/admin_listeUsagers.php");
		include("vues/admin_pied.php");
	}

	private function listeBouteille()
	{
		$bte = new Bouteille();
		$cellier = $bte->getListeBouteilleCellier();
		// var_dump($cellier);
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

	private function rechercheBouteilles()
	{

		if (isset($_GET['rech'])) {
			$this->getCatalogResultRech($_GET['rech']);
		}
		// if (isset($_GET['id']) &&  isset($_GET['col']) &&  isset($_GET['valeur'])) {
		// 	// var_dump($_GET);
		// 	$this->getCellierFiltre($_GET['id'], $_GET['col'], $_GET['valeur']);
		// }




	}
	private function getCatalogResultRech($rech = null)
	{
		$bte = new Bouteille();
		$user = new Usager();
		$listeUsager = $user->getListeUsager();
		$listeBouteilles = $bte->getListeBouteille();

		if (!empty($body)) {
			$body = json_decode(file_get_contents('php://input'));
			$ordre = $body->ordre;
			$champs = $body->col;
			$_SESSION['cellier_id'] = $body->id;
		} else {
			$termeRecherche = $rech;
		}


		if (empty($body)) {

			include("vues/admin_entetePrincipale.php");
			include("vues/admin_listeBouteilles.php");
			include("vues/admin_pied.php");
		}
	}


	private function rechercheUsagersCatalogue()
	{
		$usager = new Usager();
		//var_dump(file_get_contents('php://input'));
		$body = json_decode(file_get_contents('php://input'));
		//var_dump($body);
		// $listeBouteille = $bte->autocomplete($body->nom);
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

	private function ajouterBouteillePerso()
    {
        $body = json_decode(file_get_contents('php://input'));

        if (!empty($body)) {
            $bte = new Bouteille();

            $resultat = $bte->ajouterBouteillePerso($body);

            if ($resultat) {

                $idBouteilleCell = $bte->getIdBouteille($body->nom);

                if (!empty($idBouteilleCell)) {
                    echo $idBouteilleCell['id'];

                    $bte->ajouterBouteilleCellierPerso($body, $idBouteilleCell['id']);
                }
            }
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
		if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
			$msg = '';
			$saq = new SAQ();
			$bte = new Bouteille();
			$listeBouteilles = $bte->getListeBouteille();


			$user = new Usager();
			$listeUsager = $user->getListeUsager();
			//  var_dump($listeUsager);
			$_SESSION['listeUsagers'] = $listeUsager;
			$_SESSION['listeBouteilles'] = $listeBouteilles;

			// Pagination
			//determine the total number of pages available  
			$requeteTout = "Select * From vino__bouteille";

			$number_of_result = $bte->getNumRowsBouteilles($requeteTout);
			$resultats_par_page = 30;
			$number_of_page = ceil($number_of_result / $resultats_par_page);


			if (!isset($_GET['page'])) {
				$page = 1;
			} else {
				$page = $_GET['page'];
			}
			$resultatPage = $bte->pagination($resultats_par_page, $page,  $number_of_result, $requeteTout);

			// echo json_encode($listeBouteilles);
			// include("vues/admin_controls.php");
			include("vues/admin_entetePrincipale.php");
			include("vues/admin_listeBouteilles.php");
			include("vues/admin_pied.php");
		} else {
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
			include("vues/admin_entetePrincipale.php");
			include("vues/admin_modifierBouteille.php");
			include("vues/admin_pied.php");
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
	 * changerUsagerStatutAdmin
	 *
	 * @return void
	 */


	private function changerUsagerStatutAdmin()
	{

		// var_dump($_POST);
		$body = json_decode(file_get_contents('php://input'));

		// var_dump($body);
		$id = $body->id;



		$user = new Usager();

		$user->statutAdminUsager($body, $id);
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

			include("vues/admin_entetePrincipale.php");
			include("vues/admin_modifierUsager.php");
			include("vues/admin_pied.php");
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
		include("vues/admin_ajoutNonListees.php");
	}


	/**
	 * ajouterBouteilleCatalogue
	 *
	 * @return void
	 */


	private function ajouterBouteilleCatalogue() // en developpement!!!
	{

		$body = json_decode(file_get_contents('php://input'));
		// var_dump($body);
		// var_dump($_POST);
		if (!empty($body)) {
			// var_dump($_FILES['files']['name']);
			echo ($body->image);

			$bte = new Bouteille();


			$id = $body->id;

			$resultat = $bte->ajouterBouteilleNonListee($body);


			echo json_encode($resultat);
		} else {

			include("vues/admin_entetePrincipale.php");
			include("vues/admin_ajoutNonListees.php");
			include("vues/admin_pied.php");
		}
	}

	/**
	 * listeCelliers
	 *
	 * @return $dataC
	 */
	private function listeCelliers()
	{
		// $order = json_decode(file_get_contents('php://input'));
		$order = $_GET['order'];
		// $User = new Usager();
		$cel = new Cellier();
		$msg = '';
		if (isset($_SESSION['usager_id'])) {
			$dataC = $cel->getListeCellier($order);

			echo json_encode($dataC);
		} else {
			include("vues/entete.php");
			include("vues/profile.php");
			include("vues/pied.php");
		}
	}


	/**
	 * ajouter image dans le cellier personnel
	 *
	 * par usager
	 *  @return void
	 */

	private function ajouterImagePerso()
	{
	
		// var_dump($_FILES['file']);

		var_dump($_GET['image']);

		//$location = "/assets/img/bouteillePersonnalise/";
		$location = "assets/img/bouteillePersonnalise/";


		$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);


		if ($extension == 'jpg') {
			$ext = 1;
		} else if ($extension == 'gif') {
			$ext = 2;
		} else if ($extension == 'png') {
			$ext = 3;
		} else {
			$ext = 0;
		}

	
		$target = $location . $_GET['image']; // attribuer a l'image un nom unique (ajouter le timeStamp en secondes avant le nom de l'image)

		if ($ext != 0) { // si l'image a une extenssion acceptee

			if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {

				$bte = new Bouteille();

				//redimmensionner l'image 
				$redimensionImg = $bte->redimmensionImage($target, $ext, $lageur=367, $hauteur=550); // appele de la fonction qui redimmensionne l'image
				
				echo json_encode($redimensionImg);

				echo "Reussi!";
			} else {
				echo "Pas Reussi!!";
			}
		} else {
			echo 'Le format de l\'image n\'est pas conforme!';
		}
	}


	/**
	 * ajouter image dans le Catalogue general
	 * Admin
	 * @return void
	 * 
	 */

	private function ajouterImageLocal() // en developpement!!!
	{

		var_dump($_GET['image']);

		$imgFileName = str_replace(' ', '', $_FILES['file']['name']); //enlever les espaces dans les noms

		$location = "./assets/img/bouteillesNonlistees/";

		$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);


		if ($extension == 'jpg') {
			$ext = 1;
		} else if ($extension == 'gif') {
			$ext = 2;
		} else if ($extension == 'png') {
			$ext = 3;
		} else {
			$ext = 0;
		}

		$target = $location . $_GET['image']; // attribuer a l'image un nom unique (ajouter le timeStamp en secondes avant le nom de l'image)

		if ($ext != 0) { // si l'image a une extenssion acceptee

			if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {

				$bte = new Bouteille();

				//redimmensionner l'image 
				$redimensionImg = $bte->redimmensionImage($target, $ext, $lageur = 367, $hauteur = 550); // appele de la fonction qui redimmensionne l'image

				echo "Reussi!";
			} else {
				echo "Pas Reussi!!";
			}
		} else {
			echo 'Le format de l\'image n\'est pas conforme!';
		}
	}


	/**
	 * getListeBouteilles
	 *
	 * @return void
	 */
	function getListeBouteilles()
	{
		if (isset($_GET['id']) &&  isset($_GET['ordre']) && isset($_GET['col'])) {
			$this->getCellierTrie($_GET['id'], $_GET['ordre'], $_GET['col']);
		}
		if (isset($_GET['id']) &&  isset($_GET['col']) &&  isset($_GET['valeur'])) {
			// var_dump($_GET);
			$this->getCellierFiltre($_GET['id'], $_GET['col'], $_GET['valeur']);
		}
	}

	/**
	 * getCellierTrie retourne l'information sur un cellier donné
	 *
	 * @return void
	 */
	private function getCellierTrie($idCell = null, $tri = null, $col = null)
	{
		$cel = new Cellier();
		$bte = new Bouteille();
		if (!empty($body)) {
			$body = json_decode(file_get_contents('php://input'));
			$ordre = $body->ordre;
			$champs = $body->col;
			$_SESSION['cellier_id'] = $body->id;
		} else {
			$ordre = $tri;
			$champs = $col;
			$_SESSION['cellier_id'] = $idCell;
		}
		// echo $body->id;
		//echo $ordre;

		//  echo $_SESSION['cellier_id'];

		$dataB = $bte->getListeBouteilleCellierTrie($ordre, $champs);
		$dataC = $cel->getCellierInfo();
		$celNom = $cel->getCellierNom($_SESSION['cellier_id']);
		$_SESSION['cellier_nom'] = $celNom['nom_cellier'];


		if (empty($body)) {
			include("vues/entete.php");
			include("vues/cellier.php");
			include("vues/pied.php");
		}
	}
	/**
	 * getCellierFiltre retourne l'information filtree par Millesime, Pays ou Type pour un cellier donné
	 *
	 * @return void
	 */
	private function getCellierFiltre($idCell = null, $colonne = null, $val = null)
	{

		$cel = new Cellier();
		$bte = new Bouteille();
		if (!empty($body)) {
			$body = json_decode(file_get_contents('php://input'));
			$col = $body->col;
			$valeur = $body->valeur;
			// $champs = $body->col;
			$_SESSION['cellier_id'] = $body->id;
		} else {
			$col = $colonne;
			$valeur = $val;
			$_SESSION['cellier_id'] = $idCell;
		}
		// echo $body->id;
		//echo $ordre;

		//  echo $_SESSION['cellier_id'];
		$effacer = '';
		$id = 0;

		$dataB = $bte->getListeBouteilleCellierFiltre($col, $valeur);
		$dataC = $cel->getCellierInfo();
		$celNom = $cel->getCellierNom($_SESSION['cellier_id']);
		$_SESSION['cellier_nom'] = $celNom['nom_cellier'];
		$id = $_SESSION['cellier_id'];
		$effacer = 1;

		if (empty($body)) {
			include("vues/entete.php");
			include("vues/cellier.php");
			include("vues/pied.php");
		}
	}
}
