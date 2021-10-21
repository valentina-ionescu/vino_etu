<?php

/**
 * Class Usager
 * 
 * Cette classe possède les fonctions de gestion des usagers.
 * 
 * @author PW2-DFV
 * @version 1.0
 */
class Usager extends Modele {

    const TABLE = 'vino__usager';
    
    /**
     * getListeUsager - Cette méthode récupère la liste de tous les usagers 
     *
     * @return void
     */    
    
    public function getListeUsager()
	{
        return $rows;
    }  
    
    /**
     * getUsagerId  - Cette méthode récupere les données d'un seul usager identifié par $id
     *
     * @param  mixed $id
     * @return void
     */
    public function getUsagerId($id)
	{
        return $row;
    }   
        
    /**
     * ajouterUsager Cette méthode ajoute un usager avec les données reçues dans $data
     *
     * @param  Array $data Tableau des données du usager à inserer
     * @return int   $id du nouveau usager inséré
     */
    public function ajouterUsager($data)
	{
        return $id;
    }   
        
    /**
     * supprimerUsager
     *
     * @param  int id de l'usager à supprimer
     * @return Boolean succés ou échec de l'ajout
     */
    public function supprimerUsager($id)
	{
        
        return $res;
    }   
        
    /**
     * modifierUsager met à jour les informations d'un usager existant
     *
     * @param  Array $data nouvelles données du Usager à modifier
     * @return Boolean succés ou échec de l'ajout
     */
    public function modifierUsager($data)
	{
        return $res;
    }   

    

}
