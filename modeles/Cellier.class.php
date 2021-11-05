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

        $requete = "SELECT id, nom_cellier, usager_id FROM vino__cellier WHERE usager_id = ".$idUser."";

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

        $requete = "INSERT INTO vino__cellier (nom_cellier, usager_id) VALUE ('".$nomCellier."', '".$idUser."')";

        $res = $this->_db->query($requete);

		return $res;
    }   

    /**
     * getListeCellier - Cette méthode récupère la liste de tous les celliers 
     *
     * @return void
     */    

    public function getListeCellier()
	{
       
       
    }  
    
    
    /**
     * getCellierNom
     *
     * @param  mixed $id
     * @return void
     */
    public function getCellierNom($id)
	{
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
        
       // return $res;
    }   
        
    /**
     * modifierCellier met à jour les informations d'un cellier existant
     *
     * @param  Array $data nouvelles données du cellier à modifier
     * @return Boolean succés ou échec de l'ajout
     */
    public function modifierCellier($data)
	{
       // return $res;
    }   

    

}
