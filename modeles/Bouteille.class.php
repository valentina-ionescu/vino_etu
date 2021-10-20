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
		
		$rows = Array();
		$requete ='SELECT 
						c.nom_cellier,
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
						b.description
/*						t.type */
						from vino__cellier c 
						INNER JOIN vino__cellier_has_vino__bouteille ON c.id = vino__cellier_has_vino__bouteille.vino__cellier_id
						INNER JOIN vino__bouteille b ON vino__cellier_has_vino__bouteille.vino__bouteille_id = b.id
						/*INNER JOIN vino__type t ON vino__bouteille.vino__type_id = t.id*/
						'; 
		if(($res = $this->_db->query($requete)) ==	 true)
		{
			if($res->num_rows)
			{
				while($row = $res->fetch_assoc())
				{
					$row['nom'] = trim(utf8_encode($row['nom']));
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
		$requete ='SELECT id, nom FROM vino__bouteille where LOWER(nom) like LOWER("%'. $nom .'%") LIMIT 0,'. $nb_resultat; 
		//var_dump($requete);
		if(($res = $this->_db->query($requete)) ==	 true)
		{
			if($res->num_rows)
			{
				while($row = $res->fetch_assoc())
				{
					$row['nom'] = trim(utf8_encode($row['nom']));
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
	 * Cette méthode ajoute une ou des bouteilles au cellier
	 * 
	 * @param Array $data Tableau des données représentants la bouteille.
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
	public function ajouterBouteilleCellier($data)
	{
		/*//TODO : Valider les données.
		//var_dump($data);	
		
		$requete = "INSERT INTO vino__cellier_has_vino__bouteille(id_bouteille,date_achat,garde_jusqua,notes,prix,quantite,millesime) VALUES (".
		"'".$data->id_bouteille."',".
		"'".$data->date_achat."',".
		"'".$data->garde_jusqua."',".
		"'".$data->notes."',".
		"'".$data->prix."',".
		"'".$data->quantite."',".
		"'".$data->millesime."')";
*/
        $res = $this->_db->query($requete);
        
		$req = "SELECT quantite FROM vino__cellier_has_vino__bouteille WHERE vino__bouteille_id = ". $id;
		$res = $this->_db->query($req);
		$row = $res->fetch_row();
		$valeur = $row[0] ?? false;
		return $valeur;

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
	 * Cette méthode recupère quantité d'une bouteille en particulier dans le cellier
	 * 
	 * @param int $id id de la bouteille
	 * 
	 *  
	 * @return int quantité.
	 */
	public function getQuantiteBouteilleCellier($id)
	{
		
		$req = "SELECT quantite FROM vino__cellier_has_vino__bouteille WHERE vino__bouteille_id = ". $id;
		$res = $this->_db->query($req);
		$row = $res->fetch_row();
		$valeur = $row[0] ?? false;
		return $valeur;
	}
}




?>