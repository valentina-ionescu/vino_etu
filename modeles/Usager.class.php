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

        $requete = mysqli_prepare($connexion, "SELECT vino__usager.email, vino__usager.id, vino__usager.password, vino__usager.nom, vino__usager.prenom, vino__usager.username, vino__usager.admin FROM vino__usager WHERE email = ?");

        if($requete) 
        {
            mysqli_stmt_bind_param($requete, 's',$email);

            mysqli_stmt_execute($requete);

            $resultat = mysqli_stmt_get_result($requete);

            $usager = $resultat->fetch_assoc();

            if (isset($usager['nom'])) {
                $initiales = $this->initials($usager['prenom'].' '.$usager['nom']);
                print_r($initiales);
                $_SESSION['initiales']=$initiales;
                $_SESSION['nom'] = $usager['nom'];
                $_SESSION['usager_id'] = $usager['id'];
                $_SESSION['admin'] = $usager['admin'];
                $_SESSION['prenom'] = $usager['prenom'];
                $_SESSION['email'] = $usager['email'];
                $_SESSION['username'] = $usager['username'];
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

        $dbpassword = $row['password'];

        return password_verify($password, $dbpassword);
    }
    
    /**
     * inscription
     *
     * @param  mixed $data
     * @param  mixed $hashPass
     * @return void
     */
    public function inscription($data, $hashPass){

        $requete = "INSERT INTO vino__usager (nom, prenom, username, email, password) VALUE ('".$data->nom."', '".$data->prenom."', '".$data->username."', '".$data->email."', '".$hashPass."')";
   
        $res = $this->_db->query($requete);

		return $res;
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

    
    public function supprimerUsager($id)
	{
        $requete = "DELETE FROM vino__usager WHERE id = '".$id."'";

        $res = $this->_db->query($requete);

        var_dump($res);

		return $res;
    }


    public function modifierUsager($data, $id)
	{
        $connexion = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

        $options = [
            'cost' => 12,
        ];

        $hashPassword= password_hash($data->password, PASSWORD_BCRYPT, $options);

		$requete = mysqli_prepare($connexion, "UPDATE vino__usager SET nom = ?, email =? , prenom =? , username =? , password = ? WHERE id = ?");	

        if($requete)
        {
            mysqli_stmt_bind_param($requete, 'sssssi', $data->nom, $data->email, $data->prenom, $data->username, $hashPassword, $id);

            mysqli_stmt_execute($requete);

            $resultat = mysqli_stmt_get_result($requete);

            if ($requete) {
                $_SESSION['nom'] = $data->nom;
                $_SESSION['prenom'] = $data->prenom;
                $_SESSION['username'] = $data->username;
                $_SESSION['email'] = $data->email;
                $_SESSION['password'] = $data->password;
                $_SESSION['initiales'] = $this->initials($data->prenom.' '.$data->nom);
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
