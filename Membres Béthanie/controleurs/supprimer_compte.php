<?php
    session_start();

    require_once('../modeles/compte.php');
    require_once('../modeles/connexion.php');

    if (isset($_SESSION["compte"])){
        $c = $_SESSION["compte"];
		$coBd = new Connexion("dbpersbethanie");
		$co = $coBd->connexion();

		$result = mysqli_query($co, "UPDATE compte SET statut_compte='Supprimé', date_suppression=curdate(), heure_suppression=curtime() WHERE id_compte=$c");

		$result0 = mysqli_query($co, "SELECT login, mdp FROM compte WHERE id_compte=$c");
									 
		while ($row = mysqli_fetch_assoc($result0)){
			$pwd = str_replace("'","''",$row['mdp']);
            $login = str_replace("'","''",$row['login']);
			$m = new Compte($co,$login,$pwd);
			$m->deconnexion();
		}
        
		header('Location: ../vues/connexion.php');
	}
?>