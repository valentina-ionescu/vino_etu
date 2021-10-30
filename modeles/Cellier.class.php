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


    public function getCellierInfo()
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
     * getListeCellier - Cette méthode récupère la liste de tous les celliers 
     *
     * @return void
     */    

    public function getListeCellier()
	{
       
       
    }  
    
    /**
     * getCellierId  - Cette méthode récupere les données d'un seul cellier identifié par $id
     *
     * @param  mixed $id
     * @return void
     */
    public function getCellierId($id)
	{
      //  return $row;
    }
        
    /**
     * ajouterCellier Cette méthode ajoute un cellier avec les données reçues dans $data
     *
     * @param  Array $data Tableau des données du cellier à inserer
     * @return int   $id du nouveau cellier inséré
     */
    public function ajouterCellier($data)
	{
       // return $id;
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
