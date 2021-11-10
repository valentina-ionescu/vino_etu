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
		$requete ='SELECT id, nom, prix_saq FROM vino__bouteille where LOWER(nom) like LOWER("%'. $nom .'%") LIMIT 0,'. $nb_resultat; 
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
	
}




?>