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
     * connexion
     *
     * @return void
     */
    public function connexion(){

        $connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

        $email = $_POST['email'];

        $requete = mysqli_prepare($connexion, "SELECT vino__usager.email, vino__usager.id, vino__usager.password, vino__usager.nom, vino__usager.prenom, vino__usager.admin FROM vino__usager WHERE email = ?");

        if($requete) 
        {
            mysqli_stmt_bind_param($requete, 's',$email);

            mysqli_stmt_execute($requete);

            $resultat = mysqli_stmt_get_result($requete);

            $usager = $resultat->fetch_assoc();

            if (isset($usager['nom'])) {
                $initiales = $this->initials($usager['prenom'].' '.$usager['nom']);
                
                $_SESSION['initiales']=$initiales;
                $_SESSION['nom'] = $usager['nom'];
                $_SESSION['usager_id'] = $usager['id'];
                $_SESSION['admin'] = $usager['admin'];
                $_SESSION['prenom'] = $usager['prenom'];
                $_SESSION['email'] = $usager['email'];
            }
        }
    }
    
    /**
     * deconnexion
     *
     * @return void
     */
    public function deconnexion(){

        session_destroy();
    }

    
    /**
     * hashPassword
     *
     * @param  mixed $password
     * @return void
     */
    public function hashPassword($password){
        $options = [
            'cost' => 12,
        ];
        $hashPassword= password_hash($password, PASSWORD_BCRYPT, $options);
  
        return $hashPassword;
    }
    
    /**
     * checkPassword
     *
     * @param  mixed $password
     * @param  mixed $email
     * @return void
     */
    public function checkPassword($password, $email){
        
        $requete = "SELECT password FROM vino__usager WHERE email = '".$email."'";
        
        $res = $this->_db->query($requete);

        $row = $res->fetch_assoc();

        if ($row) {

            $dbpassword = $row['password'];
            
            return password_verify($password, $dbpassword);
        }
    }
    
    /**
     * inscription
     *
     * @param  mixed $data
     * @param  mixed $hashPass
     * @return void
     */
    public function inscription($data, $hashPass){

        $connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

		$requete =  mysqli_prepare($connexion,"INSERT INTO vino__usager(nom, prenom, email, password) VALUE (?, ?, ?, ?)");
   
		if($requete)
        {
            mysqli_stmt_bind_param($requete, 'ssss', $data->nom, $data->prenom, $data->email, $hashPass);

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
     * getListeUsager - Cette méthode récupère la liste de tous les usagers 
     *
     * @return void
     */    
    
    public function getListeUsager()
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

    
    /**
     * getUsagerId  - Cette méthode récupere les données d'un seul usager identifié par $id
     *
     * @param  mixed $id
     * @return void
     */
    public function getUsagerId($id)
	{
        //      
    }   
        
    public function getUsagerById($id)
	{
       $requete = "SELECT * FROM vino__usager WHERE vino__usager.id =".$id." ";

		
		$res = $this->_db->query($requete);

		
		return $res;
    }   
    /**
     * ajouterUsager Cette méthode ajoute un usager avec les données reçues dans $data
     *
     * @param  Array $data Tableau des données du usager à inserer
     * @return int   $id du nouveau usager inséré
     */
    public function ajouterUsager($data)
	{
//        return $id;
    }   
        

        
  
    public function supprimerUsager($id)
	{
        $requete = "DELETE FROM vino__usager WHERE id = '".$id."'";

        $res = $this->_db->query($requete);

        var_dump($res);

		return $res;
    }

  /**
     * modifierUsager met à jour les informations d'un usager existant
     *
     * @param  Array $data nouvelles données du Usager à modifier
     * @return Boolean succés ou échec de l'ajout
     */
    public function modifierUsager($data, $id)
	{
        $connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

        $options = [
            'cost' => 12,
        ];

        $hashPassword= password_hash($data->password, PASSWORD_BCRYPT, $options);

		$requete = mysqli_prepare($connexion, "UPDATE vino__usager SET nom = ?, email =? , prenom =? , password = ? WHERE id = ?");	

        if($requete)
        {
            mysqli_stmt_bind_param($requete, 'ssssi', $data->nom, $data->email, $data->prenom, $hashPassword, $id);

            mysqli_stmt_execute($requete);

            $resultat = mysqli_stmt_get_result($requete);

            if ($requete) {
                $_SESSION['nom'] = $data->nom;
                $_SESSION['prenom'] = $data->prenom;
                $_SESSION['email'] = $data->email;
                $_SESSION['password'] = $data->password;
                $_SESSION['initiales'] = $this->initials($data->prenom.' '.$data->nom);
            }
        }
    }

/**
     * modifierUsagerCatalogue met à jour les informations d'un usager existant par l'administrateur
     *
     * @param  Array $data nouvelles données du Usager à modifier
     * @return Boolean succés ou échec de l'ajout
     */

    public function modifierUsagerCatalogue($data, $id)
	{
        $connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

        $options = [
            'cost' => 12,
        ];

        $hashPassword= password_hash($data->password, PASSWORD_BCRYPT, $options);

		$requete = mysqli_prepare($connexion, "UPDATE vino__usager SET nom = ?, email =? , prenom =? , username =? , password = ?, admin=? WHERE id = ?");	

        if($requete)
        {
            mysqli_stmt_bind_param($requete, 'ssssssi', $data->nom, $data->email, $data->prenom, $data->username, $hashPassword, $data->admin, $id);

            mysqli_stmt_execute($requete);

            $resultat = mysqli_stmt_get_result($requete);

            if(!$resultat){
				var_dump($resultat);
			}
			else{

			}
        }
    }


    /**
     * statutAdminUsager donne le statut d'admin a un usager existant -- par l'administrateur
     *
     * @param  Array $data nouvelles données du Usager à modifier
     * @param  Int $id le id de l'Usager à modifier
     * @return Boolean succés ou échec de l'ajout
     */

    public function statutAdminUsager($data, $id)
	{ var_dump($data->admin);
        $connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

		$requete = mysqli_prepare($connexion, "UPDATE vino__usager SET admin=? WHERE id = ?");	

        if($requete)
        {
            mysqli_stmt_bind_param($requete, 'si', $data->admin, $id);

            mysqli_stmt_execute($requete);

            $resultat = mysqli_stmt_get_result($requete);

            if(!$resultat){
				var_dump($resultat);
			}
			else{

			}
        }
    }



    /**
    * initials retourne les initiales d'un usager à partir des nom et prénom
    *
    * @return string
    */
    public function initials($nomc) {
        preg_match('/(?:\w+\. )?(\w+).*?(\w+)(?: \w+\.)?$/', $nomc, $result);
        return strtoupper($result[1][0].$result[2][0]);
    }





}
