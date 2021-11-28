<?php

/**
 * Class Cellier
 * 
 * Cette classe possède les fonctions de gestion descelliers.
 * 
 * @author PW2-DFV
 * @version 1.0
 */
class Cellier extends Modele {

    const TABLE = 'vino__cellier';

    
    /**
     * getCellierInfo
     *
     * @return void
     */
    public function getCellierInfo()
	{

        $idUser = $_SESSION['usager_id'];
        
		$rows = Array();

       
        // $requete = "SELECT id, nom_cellier, usager_id FROM vino__cellier WHERE usager_id = ".$idUser."";
        $requete = "SELECT id, nom_cellier, usager_id, sum(v.quantite) bqte FROM vino__cellier 
                    left join vino__cellier_has_vino__bouteille v on vino__cellier_id = id
                    WHERE usager_id = ".$idUser." GROUP BY id, nom_cellier,usager_id 
                    ORDER BY nom_cellier";
        
    

		if(($res = $this->_db->query($requete)) == true)
        {
            if($res->num_rows)
            {
                while($row = $res->fetch_assoc())
                {
                    $rows[] = $row;
                }
            }
        }
        
       
        return $rows;
    }
    
    /**
     * getCellierBouteille
     *
     * @return void
     */
    public function getCellierBouteille()
	{

        $idUser = $_SESSION['usager_id'];
        
		$rows = Array();

        $requete = "SELECT id, nom_cellier, usager_id FROM vino__cellier WHERE usager_id = ".$idUser."";

		if(($res = $this->_db->query($requete)) ==	 true)
        {
            if($res->num_rows)
            {
                while($row = $res->fetch_assoc())
                {
                    $rows[] = $row;
                }
            }
        }

        return $rows;
    }
    
    
    /**
     * ajouterCellier
     *
     * @param  mixed $nomCellier
     * @return void
     */
    public function ajouterCellier($nomCellier)
	{
        $idUser = $_SESSION['usager_id'];

        $connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

		$requete =  mysqli_prepare($connexion, "INSERT INTO vino__cellier(nom_cellier, usager_id) VALUE (?, ?)");

        if($requete)
        {
            mysqli_stmt_bind_param($requete, 'si', $nomCellier, $idUser);

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

    /**
     * getListeCellier - Cette méthode récupère la liste de tous les celliers 
     *
     * @return void
     */    

    public function getListeCellier($order)
	{
        $idUser = $_SESSION['usager_id'];
        
		$rows = Array();

        
        $requete = "SELECT  nom_cellier FROM vino__cellier WHERE usager_id = ".$idUser." ORDER BY nom_cellier ".$order . "";
   
		if(($res = $this->_db->query($requete)) == true)
        {
            if($res->num_rows)
            {
                while($row = $res->fetch_assoc())
                {
                    $rows[] = $row;
                }
            }
        }
        
        return $rows;
       
    }  
    
    
    /**
     * getCellierNom
     *
     * @param  mixed $id
     * @return void
     */
    public function getCellierNom($id)
	{
        $idUser = $_SESSION['usager_id'];
        
       
        $requete = "SELECT nom_cellier FROM vino__cellier WHERE id = ".$id."";

        $res = $this->_db->query($requete);

        $row = $res->fetch_assoc();

        
		return $row;
    }
        
    /**
     * supprimerCellier
     *
     * @param  int id du cellier à supprimer
     * @return Boolean succés ou échec de l'ajout
     */
    public function supprimerCellier($id)
	{
        $connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		$requete = mysqli_prepare($connexion, "DELETE FROM vino__cellier  WHERE id = ?");	
		if($requete)
        {
            mysqli_stmt_bind_param($requete, 'i',$id);

            $res = mysqli_stmt_execute($requete);
            print_r($res);
			return $res;
		}	
       
    }   
        
    /**
     * modifierCellier met à jour les informations d'un cellier existant
     *
     * @param  Array $data nouvelles données du cellier à modifier
     * @return Boolean succés ou échec de l'ajout
     */
    public function modifierCellier($data)
	{
        $connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		

		$requete = mysqli_prepare($connexion, "UPDATE vino__cellier SET nom_cellier = ? WHERE id = ?");	

        if($requete)
        {
            mysqli_stmt_bind_param($requete, 'si',$data->nom_cellier, $data->id);

            mysqli_stmt_execute($requete);

            $resultat = mysqli_stmt_get_result($requete);

            
            return $resultat;
        }
    }   




/**
 * sQuantiteBouteillesCellier
 *
 * @return void
 */
public function sQuantiteBouteillesCellier($id) {

	$requete = "SELECT sum(quantite) FROM `vino__cellier_has_vino__bouteille` where vino__cellier_id = ". $id ."";
	$res = $this->_db->query($requete);
	$row = $res->fetch_row();
	$valeur = $row[0] ?? false;
	return $valeur;
}

 } //fin cellier
