<?php

/**
 * Class Bouteille
 * Cette classe possède les fonctions de gestion des bouteilles dans le cellier et des bouteilles dans le catalogue complet.
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */
class Bouteille extends Modele {
	const TABLE = 'vino__bouteille';
    
	public function getListeBouteille()
	{
		
		$rows = Array();
		$res = $this->_db->query('Select * from '. self::TABLE);
		if($res->num_rows)
		{
			while($row = $res->fetch_assoc())
			{
				$rows[] = $row;
			}
		}
		
		return $rows;
	}
	
	public function getListeBouteilleCellier()
	{
		
		$idCellier = $_SESSION['cellier_id'];

		$rows = Array();
		$requete ='SELECT 
						c.nom_cellier,
						c.id as cellier_id,
						vino__cellier_has_vino__bouteille.date_achat,
						vino__cellier_has_vino__bouteille.garde_jusqua,
						vino__cellier_has_vino__bouteille.notes,
						vino__cellier_has_vino__bouteille.prix,
						vino__cellier_has_vino__bouteille.quantite,
						vino__cellier_has_vino__bouteille.vino__bouteille_id,
						vino__cellier_has_vino__bouteille.vino__cellier_id,
						vino__cellier_has_vino__bouteille.millesime,
						b.id,
						b.nom,
						b.vino__type_id,
						b.image,
						b.code_saq,
						b.url_saq,
						b.pays,
						b.description,
						b.format
/*						t.type */
						from vino__cellier c 
						INNER JOIN vino__cellier_has_vino__bouteille ON c.id = vino__cellier_has_vino__bouteille.vino__cellier_id
						INNER JOIN vino__bouteille b ON vino__cellier_has_vino__bouteille.vino__bouteille_id = b.id
						/*INNER JOIN vino__type t ON vino__bouteille.vino__type_id = t.id*/
						WHERE vino__cellier_id = '.$idCellier.'
						'; 
		if(($res = $this->_db->query($requete)) ==	 true)
		{

			if($res->num_rows)
			{
				while($row = $res->fetch_assoc())
				{
					$row['nom'] = trim(htmlspecialchars($row['nom']));
					$rows[] = $row;
				}
			 }
		}
		else 
		{
			throw new Exception("Erreur de requête sur la base de donnée", 1);
			 //$this->_db->error;
		}
		
		
		
		return $rows;
	}


  
	/**
	 * Cette méthode permet de retourner les résultats de recherche pour la fonction d'autocomplete de l'ajout des bouteilles dans le cellier
	 * 
	 * @param string $nom La chaine de caractère à rechercher
	 * @param integer $nb_resultat Le nombre de résultat maximal à retourner.
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return array id et nom de la bouteille trouvée dans le catalogue
	 */
       
	public function autocomplete($nom, $nb_resultat=10)
	{
		
		$rows = Array();
		$nom = $this->_db->real_escape_string($nom);
		$nom = preg_replace("/\*/","%" , $nom);
		 
		//echo $nom;
		
		$requete ='SELECT id, nom, prix_saq FROM vino__bouteille WHERE usager_id = '.$_SESSION['usager_id'].' AND LOWER(nom) like LOWER("%'. $nom .'%") AND statut_desactive !=1 OR statut_desactive is NULL OR usager_id is NULL AND LOWER(nom) like LOWER("%'. $nom .'%") AND statut_desactive !=1 OR statut_desactive is NULL LIMIT 0,'. $nb_resultat; 
		
		//var_dump($requete);
		if(($res = $this->_db->query($requete)) ==	 true)
		{
			if($res->num_rows)
			{
				while($row = $res->fetch_assoc())
				{
					// $row['nom'] = trim(utf8_encode($row['nom']));
				
					$row['nom'] = trim(htmlspecialchars($row['nom']));
					$rows[] = $row;
					
				}
			}
		}
		else 
		{
			throw new Exception("Erreur de requête sur la base de données", 1);
			 
		}
		
		
		//var_dump($rows);
		return $rows;
	}
		/**
	 * Cette méthode permet de retourner le dernier id de la table vino__bouteille
	 * 
	 * @param string $nom La chaine de caractère à rechercher
	 * @param integer $nb_resultat Le nombre de résultat maximal à retourner.
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return integer id de la derniere bouteille inserree dans le catalogue
	 */
       
/**
	 * Cette méthode selectionne les infos d'une bouteille  en particulier dans le catalogue
	 * 
	 * @param int $idBouteille id de la bouteille
	 * @param int $idCellier id du cellier
	 * 
	 */
	public function getBouteilleById($idBouteille)
	{

		$requete = "SELECT nom, image, code_saq, pays, description, prix_saq, url_saq, format, vino__type_id FROM vino__bouteille JOIN vino__type ON vino__bouteille.vino__type_id = vino__type.id WHERE vino__bouteille.id =".$idBouteille." ";

		
		$res = $this->_db->query($requete);

		// var_dump($idBouteille);
		return $res;

		/*	$idCellier = $_SESSION['cellier_id'];

		$requete = "SELECT date_achat, garde_jusqua, notes, prix, millesime, vino__bouteille.nom,vino__bouteille.image FROM vino__cellier_has_vino__bouteille JOIN vino__bouteille ON vino__cellier_has_vino__bouteille.vino__bouteille_id = vino__bouteille.id WHERE vino__bouteille_id = ".$idBouteille." AND vino__cellier_id = ".$idCellier."";

		$res = $this->_db->query($requete);

		return $res; */
	}
	
	/**
	 * Cette méthode ajoute une ou des bouteilles au cellier
	 * 
	 * @param Array $data Tableau des données représentants la bouteille.
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
	public function ajouterBouteilleCellier($data)
	{
		/*//TODO : Valider les données.*/
		// INSERT INTO `vino__cellier_has_vino__bouteille` (`vino__cellier_id`, `vino__bouteille_id`, `quantite`, `date_achat`, `garde_jusqua`, `notes`, `prix`, `millesime`) VALUES ('10', '2', '5', '2021-10-04', '3ans', NULL, '23,78', '2021');

		$vino__cellier_id = $_SESSION['cellier_id'];

		$requete = "INSERT INTO vino__cellier_has_vino__bouteille(
            -- id_bouteille,
            vino__bouteille_id,
			quantite,
            date_achat,
            garde_jusqua,
            prix,
            vino__cellier_id,
            millesime) 
        VALUES (".
        "'".$data->vino__bouteille_id."',".
		"'".$data->quantite."',".
        "'".$data->date_achat."',".
        "'".$data->garde_jusqua."',".
        "'".$data->prix."',".
        "'".$vino__cellier_id."',".
        "'".$data->millesime."')";

        $res = $this->_db->query($requete);
        
	

		return $res;
	}
	

	public function ajouterBouteilleCellierPerso($body, $id)
	{
		$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

		$Cid = $_SESSION['cellier_id'];
		$Dachat = date('Y-m-d');


		$requete = mysqli_prepare($connexion, "INSERT INTO vino__cellier_has_vino__bouteille (vino__cellier_id, vino__bouteille_id, date_achat, prix) VALUES (?,?,?,?)");	

        if($requete)
        {
            //mysqli_stmt_bind_param($requete, 'iiss', $_SESSION['cellier_id'], $id, $body->date_achat,$body->prix);
            mysqli_stmt_bind_param($requete, 'iiss', $Cid, $id, $Dachat,$body->prix);

            mysqli_stmt_execute($requete);

            $resultat = mysqli_stmt_get_result($requete);

            if(!$resultat){
				var_dump($resultat);
			}
        }
	}
	

	public function getIdBouteille($nomBoutPerso)
	{
		$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

		$requete = mysqli_prepare($connexion, "SELECT id FROM vino__bouteille WHERE nom = ?");	

		if($requete)
        {
            //mysqli_stmt_bind_param($requete, 'iiss', $_SESSION['cellier_id'], $id, $body->date_achat,$body->prix);
            mysqli_stmt_bind_param($requete, 's', $nomBoutPerso);

            mysqli_stmt_execute($requete);

            $resultat = mysqli_stmt_get_result($requete);

			$row = $resultat->fetch_assoc();
        
			return $row;
            if(!$resultat){
				var_dump($resultat);
			}
        }
		//$res = $this->_db->query($requete);

        //$row = $res->fetch_assoc();
        
		//return $row;
	}
	
	/**
	 * Cette méthode change la quantité d'une bouteille en particulier dans le cellier
	 * 
	 * @param int $id id de la bouteille
	 * @param int $nombre Nombre de bouteille a ajouter ou retirer
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
	public function modifierQuantiteBouteilleCellier($id, $nombre)
	{
		//TODO : Valider les données.
			
		$requete = "UPDATE vino__cellier_has_vino__bouteille SET quantite = GREATEST(quantite + ". $nombre. ", 0) WHERE vino__bouteille_id = ". $id;
		//echo $requete;
        $res = $this->_db->query($requete);

		//retourner la qte restante
        $res = $this->getQuantiteBouteilleCellier($id);
		return $res;
	}


	/**
	 * Cette méthode change la quantité d'une bouteille en particulier dans le cellier
	 * 
	 * @param int $id id de la bouteille
	 * @param int $nombre Nombre de bouteille a ajouter ou retirer
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
	public function modifierBouteilleCellier($data, $id)
	{
		$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		str_replace($data->prix, ",", ".");

		$requete = mysqli_prepare($connexion, "UPDATE vino__cellier_has_vino__bouteille SET millesime = ?, date_achat =? , prix =? , garde_jusqua =? , notes = ? WHERE vino__bouteille_id = ?");	

        if($requete)
        {
            mysqli_stmt_bind_param($requete, 'issssi',$data->millesime, $data->date_achat,$data->prix, $data->garde_jusqua, $data->notes, $id);

            mysqli_stmt_execute($requete);

            $resultat = mysqli_stmt_get_result($requete);

            if(!$resultat){
				var_dump($resultat);
			}
        }
	}
	
	/**
	 * supprimerBouteilleCellier - Cette méthode supprime une bouteille en particulier dans le cellier
	 *
	 * @param  mixed $id
	 * @return void
	 */
	public function supprimerBouteilleCellier($id) {
		$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		$requete = mysqli_prepare($connexion, "DELETE FROM vino__cellier_has_vino__bouteille  WHERE vino__bouteille_id = ?");	
		if($requete)
        {
            mysqli_stmt_bind_param($requete, 'i',$id);

            $res = mysqli_stmt_execute($requete);
			return $res;
		}	
	}




	/**
	 * Cette méthode change la quantité d'une bouteille en particulier dans le cellier
	 * 
	 * @param int $idBouteille id de la bouteille
	 * @param int $idCellier id du cellier
	 * 
	 */
	public function getInfoBouteille($idBouteille)
	{
		$idCellier = $_SESSION['cellier_id'];

		$requete = "SELECT date_achat, garde_jusqua, notes, prix, millesime, vino__bouteille.nom,vino__bouteille.image FROM vino__cellier_has_vino__bouteille JOIN vino__bouteille ON vino__cellier_has_vino__bouteille.vino__bouteille_id = vino__bouteille.id WHERE vino__bouteille_id = ".$idBouteille." AND vino__cellier_id = ".$idCellier."";

		$res = $this->_db->query($requete);

		return $res;
	}


	/**
	 * Cette méthode recupère quantité d'une bouteille en particulier dans le cellier
	 * 
	 * @param int $id id de la bouteille
	 * 
	 *  
	 * @return int $quantité la quantité pour une bouteille($id) dans un cellier
	 */
	public function getQuantiteBouteilleCellier($id)
	{
		
		$req = "SELECT quantite FROM vino__cellier_has_vino__bouteille WHERE vino__bouteille_id = ". $id;
		$res = $this->_db->query($req);
		$row = $res->fetch_row();
		$valeur = $row[0] ?? false;
		return $valeur;
	}

/**
	 * Cette méthode supprime/ajoute le statut desactive d'une bouteille en particulier dans le catalogue
	 * 
	 * @param int $id id de la bouteille
	 * 
	 *  
	 * @return int $quantité la quantité pour une bouteille($id) dans un cellier
	 */
	public function supprimerBouteilleCatalogue($id)
	{
		$msg = "";
		$statut = 1;

		$requete = "UPDATE vino__bouteille SET statut_desactive =1 WHERE vino__bouteille.id = ".$id."";
	
		$res = $this->_db->query($requete);

		if($res){
			$msg = "La bouteille no.".$id." a été supprimée avec succès!";
		}
		return $res;

	}




	
	/**
	 * Cette méthode change la quantité d'une bouteille en particulier dans le cellier
	 * 
	 * @param int $id id de la bouteille
	 * @param int $nombre Nombre de bouteille a ajouter ou retirer
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
	public function modifierBouteilleCatalogue($data, $id)
	{
		$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		str_replace($data->prix, ",", ".");
		//UPDATE `vino__bouteille` SET `nom` = '7Colores Gran Reserva Valle Casablanca 2016 ', `url_saq` = 'URL', `vino__type_id` = '2', `statut_desactive` = '0' WHERE `vino__bouteille`.`id` = 1;
		$requete = mysqli_prepare($connexion, "UPDATE vino__bouteille SET nom=? ,image = ?, code_saq =? , pays = ?, prix_saq =? , url_saq =? , format = ?  WHERE vino__bouteille.id = ?");	

        if($requete)
        {
            mysqli_stmt_bind_param($requete, 'sssssssi',$data->nom, $data->image, $data->code_saq, $data->pays, $data->prix_saq, $data->url_saq, $data->format, $id);

            mysqli_stmt_execute($requete);

            $resultat = mysqli_stmt_get_result($requete);

            if(!$resultat){
				var_dump($resultat);
			}
        }


		
	}

		/**
	 * Cette méthode ajoute une ou des bouteilles au cellier
	 * 
	 * @param Array $data Tableau des données représentants la bouteille.
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
	public function ajouterBouteilleNonListee($data)
	{
		//var_dump($data);
		$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

		$requete =  mysqli_prepare($connexion, "INSERT INTO vino__bouteille( nom, image,  pays, description, prix_saq, format, vino__type_id ) 
        VALUES (".
        "'".$data->nom."',".
		 "'".$data->image."',".
		//  "'".$data->code_saq."',".
        "'".$data->pays."',".
         "'".$data->description."',".
        "'".$data->prix_saq."',".
        "'".$data->format."',".
        "'".$data->vino__type_id."')");

        
		if($requete)
        {
            mysqli_stmt_bind_param($requete, 'sssssssi',$data->nom, $data->image, $data->pays, $data->description, $data->prix_saq, $data->format, $data->vino__type_id);

            mysqli_stmt_execute($requete);

            $resultat = mysqli_stmt_get_result($requete);

            if(!$resultat){
				var_dump($resultat);
			}
			else{

			}
        }
		var_dump($resultat);

		return $resultat;
	}


	public function ajouterBouteillePerso($data)
	{
		$usager_id = $_SESSION['usager_id'];

		if ($data->type == NULL) {
			$data->type = 1;
		}

        $connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

		$requete = mysqli_prepare($connexion, "INSERT INTO vino__bouteille(nom, image, pays, prix_saq, format, vino__type_id, usager_id) VALUES (?, ?, ?, ?, ?, ?, ?)");	

        if($requete)
        {
			mysqli_stmt_bind_param($requete, 'sssssii', $data->nom, $data->image, $data->pays, $data->prix, $data->format, $data->type, $usager_id);

            mysqli_stmt_execute($requete);

            $resultat = mysqli_stmt_get_result($requete);

			
			var_dump($resultat);

			return TRUE;
		}
	}
	



	public function redimmensionImage($image, $ext, $maxDimL, $maxDimH)
	{

	

		chmod($image, 0777);
		list($largeur, $hauteur, $type, $attr) = getimagesize( $image );
		$redimImg = '';
		$origHauteur = $hauteur;
		$origLargeur = $largeur;

		//recuperer l'extension/type de l'images
		switch ($ext)
        {
            case 1;
                $source = imagecreatefromjpeg($image);
            break;

            case 2;
                $source = imagecreatefromgif($image);
            break;

            case 3;
                $source = imagecreatefrompng($image);
            break;
        }

		//creer le canevas de l'image
		$resultImg = imagecreatetruecolor($maxDimL, $maxDimH);

        $bgcolor = imagecolorallocate($resultImg, 255, 255, 255); // couleur de fond si l'image ne vouvre pas l'entieretee du canevas
        imagefill($resultImg, 0, 0, $bgcolor);       // resetter la couleur de fond a blanc. 

		if ( $largeur > $maxDimL || $hauteur > $maxDimH ) {
        // Verifier la largeur vs la hauteur de l'image et la centrer
        if($origHauteur<$origLargeur) // si la largeur d'origine est plus grande que l'hauteur
        {
            $nouvImgHauteur = $maxDimH; 
            $nouvImgLargeur = ceil(($maxDimH*$origLargeur)/$origHauteur);
            imagecopyresampled($resultImg,$source,-ceil(($nouvImgLargeur-$maxDimL)/2),0,0,0,$nouvImgLargeur,$nouvImgHauteur,$origLargeur,$origHauteur);
        }
        else
        {
            $nouvImgHauteur = ceil(($maxDimL*$origHauteur)/$origLargeur);
            $nouvImgLargeur = $maxDimL; 
            imagecopyresampled($resultImg,$source,0,-ceil(($nouvImgHauteur-$maxDimH)/2),0,0,$nouvImgLargeur,$nouvImgHauteur,$origLargeur,$origHauteur);
        }

        //we save the image as jpg resized to 110x110 px and cropped to the center. the old image will be replaced
        imagejpeg($resultImg,$image,90);
}
        return $image;

    
}





  
  //////////////////////////////////////////////
    //  Fonctions tris & filtres bouteilles      //
    //////////////////////////////////////////////


	public function getListeBouteilleCellierTrie($ordre,$champs)
	{
		
		$idCellier = $_SESSION['cellier_id'];

		$rows = Array();
		$requete ='SELECT 
						c.nom_cellier,
						c.id as cellier_id,
						vino__cellier_has_vino__bouteille.date_achat,
						vino__cellier_has_vino__bouteille.garde_jusqua,
						vino__cellier_has_vino__bouteille.notes,
						vino__cellier_has_vino__bouteille.prix as prix,
						vino__cellier_has_vino__bouteille.quantite,
						vino__cellier_has_vino__bouteille.vino__bouteille_id,
						vino__cellier_has_vino__bouteille.vino__cellier_id,
						vino__cellier_has_vino__bouteille.millesime,
						b.id,
						b.nom as nom,
						b.vino__type_id,
						b.image,
						b.code_saq,
						b.url_saq,
						b.pays,
						b.description,
						b.format
/*						t.type */
						from vino__cellier c 
						INNER JOIN vino__cellier_has_vino__bouteille ON c.id = vino__cellier_has_vino__bouteille.vino__cellier_id
						INNER JOIN vino__bouteille b ON vino__cellier_has_vino__bouteille.vino__bouteille_id = b.id
						/*INNER JOIN vino__type t ON vino__bouteille.vino__type_id = t.id*/
						WHERE vino__cellier_id = '.$idCellier.'
						 ORDER BY '.$champs .' '.$ordre; 
						
		if(($res = $this->_db->query($requete)) ==	 true)
		{

			if($res->num_rows)
			{
				while($row = $res->fetch_assoc())
				{
					$row['nom'] = trim(htmlspecialchars($row['nom']));
					$rows[] = $row;
				}
			 }
		}
		else 
		{
			throw new Exception("Erreur de requête sur la base de donnée", 1);
			 //$this->_db->error;
		}
		
		
		
		return $rows;
	}


	public function getListeBouteilleCellierFiltre($col,$valeur)
	{
		
		$idCellier = $_SESSION['cellier_id'];

		$rows = Array();
		$requete ='SELECT 
						c.nom_cellier,
						c.id as cellier_id,
						vino__cellier_has_vino__bouteille.date_achat,
						vino__cellier_has_vino__bouteille.garde_jusqua,
						vino__cellier_has_vino__bouteille.notes,
						vino__cellier_has_vino__bouteille.prix as prix,
						vino__cellier_has_vino__bouteille.quantite,
						vino__cellier_has_vino__bouteille.vino__bouteille_id,
						vino__cellier_has_vino__bouteille.vino__cellier_id,
						vino__cellier_has_vino__bouteille.millesime as millesime,
						b.id,
						b.nom as nom,
						b.vino__type_id,
						b.image,
						b.code_saq,
						b.url_saq,
						b.pays as pays,
						b.description,
						b.format
/*						t.type */
						from vino__cellier c 
						INNER JOIN vino__cellier_has_vino__bouteille ON c.id = vino__cellier_has_vino__bouteille.vino__cellier_id
						INNER JOIN vino__bouteille b ON vino__cellier_has_vino__bouteille.vino__bouteille_id = b.id
						/*INNER JOIN vino__type t ON vino__bouteille.vino__type_id = t.id*/
						WHERE vino__cellier_id = '.$idCellier.' AND '.$col ."=". $valeur; 
		if(($res = $this->_db->query($requete)) ==	 true)
		{

			if($res->num_rows)
			{
				while($row = $res->fetch_assoc())
				{
					$row['nom'] = trim(htmlspecialchars($row['nom']));
					$rows[] = $row;
				}
			 }
		}
		else 
		{
			throw new Exception("Erreur de requête sur la base de donnée", 1);
			 //$this->_db->error;
		}
		
		
		
		return $rows;
	}


	public function getNumRowsBouteilles($requete)
	{
		$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		// $requete = "Select * From vino__bouteille";  
		$result = mysqli_query($connexion, $requete);  
		$number_of_result = mysqli_num_rows($result);  
		return $number_of_result;

	}

	/**
	 * Cette méthode ajoute une ou des bouteilles au cellier
	 * 
	 * @param int $number_of_result quantite totale des bouteilles dans la page retournee par la fonction getNumRowsBouteilles().
	 * @param int $page le numero de la page sur laquelle on clique.
	 * @param int $resultats_par_page - quantitee de resultats dans une page
	 * @return Array $rows  tableau de resultats 
	 */

	public function pagination( $resultats_par_page, $page, $number_of_result, $requette)
	{
		$rows = Array();
        $connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	 
	   //Calculer le nombre des pages disponibles  
	   $number_of_page = ceil ($number_of_result / $resultats_par_page);  
	 	  
	 
	   //determiner la limite de items a afficher sur une page 
	   $page_first_result = ($page-1) * $resultats_par_page;  
	 
	   //chercher les resultats selectionnees dans la DB 
	   $maRequette = $requette.' LIMIT ' . $page_first_result . ',' . $resultats_par_page;  
	   $result = mysqli_query($connexion, $maRequette);  
		 
	   //preparer un tableau Array de resultyats pour afficher dans la page web
	   if($result->num_rows)
		{
			while($row = $result->fetch_assoc())
			{
				$rows[] = $row;
			}
		}
		
	
		return $rows;
	}  






	
	/**
	 * Cette méthode permet de retourner les résultats de recherche pour la fonction d'autocomplete de l'ajout des bouteilles dans le cellier
	 * 
	 * @param string $nom La chaine de caractère à rechercher
	 * @param integer $nb_resultat Le nombre de résultat maximal à retourner.
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return array id et nom de la bouteille trouvée dans le catalogue
	 */
       
	public function rechercheBouteillesCatalogue($recherche)
	{
		$rows = Array();
		$nom = $this->_db->real_escape_string($recherche);
		$nom = preg_replace("/\*/","%" , $recherche);
		 

		//echo $nom;
		$connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

		 //Calculer le nombre des pages disponibles  
		//  $number_of_page = ceil ($number_of_result / $resultats_par_page);  
	 	  
	 
		 //determiner la limite de items a afficher sur une page 
		//  $page_first_result = ($page-1) * $resultats_par_page;  
	   
		 //chercher les resultats selectionnees dans la DB 
		//  $query = "SELECT *FROM vino__bouteille ;  
		//  $result = mysqli_query($connexion, $query);  

		// $reqPrep =mysqli_prepare($connexion,'SELECT * FROM vino__bouteille WHERE nom LIKE ?  OR code_saq LIKE ? OR description LIKE ? AND statut_desactive !=1 OR statut_desactive is NULL'); 
		$reqPrep =mysqli_prepare($connexion,'SELECT * FROM vino__bouteille WHERE nom LIKE ?  AND statut_desactive !=1 OR statut_desactive is NULL'); 


		if($reqPrep)

        {
            $laRecherche = "%".$recherche."%";

            // mysqli_stmt_bind_param($reqPrep, 'sss', $laRecherche, $laRecherche, $laRecherche);
            mysqli_stmt_bind_param($reqPrep, 's', $laRecherche);
            
            mysqli_stmt_execute($reqPrep);
            $resultats = mysqli_stmt_get_result($reqPrep);
            // return $resultats;


			
				while($row = $resultats->fetch_assoc())
				{
				
					$rows[] = $row;
					
				}
			
        }
        else

        {
             echo "SQL Erreur !!! La recherche n'a pas fonctionne! ";
			 throw new Exception("Erreur de requête sur la base de données", 1);
        }

		return $rows;
//SELECT * FROM `vino__bouteille` WHERE CONCAT(`nom`, `code_saq`, `pays`, `description`, `format`) LIKE "% ma %"
	
//SELECT * FROM `vino__bouteille` WHERE LOWER(CONCAT(`nom`, `code_saq`, `pays`, `description`, `format`)) LIKE LOWER("% États %")
//SELECT * FROM `vino__bouteille` WHERE LOWER(CONCAT(`nom`, `code_saq`, `description`)) LIKE LOWER("% États %")

//SELECT * FROM `vino__bouteille` WHERE LOWER(`nom`) LIKE LOWER("% m %")  OR LOWER(`code_saq`) LIKE LOWER("% 1 %") OR LOWER(`description`) LIKE LOWER("% États %")
//SELECT * FROM `vino__bouteille` WHERE LOWER(`nom`) LIKE LOWER("%m%")  OR `code_saq` LIKE "%1%" OR LOWER(`description`) LIKE LOWER("%États%")
	}
	
/**
 * statsBouteilles
 *
 * @return void
 */

//  provisoire
public function statsBouteilles() {
	$query = "SELECT distinct(SUBSTRING(nom, -4)) AS y FROM vino__bouteille where SUBSTRING(nom, -4) like '20%' or SUBSTRING(nom, -4) like '19%' order by 1";
}	
}
