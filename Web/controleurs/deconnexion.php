<?php
	require_once("../modeles/connexion.php");
	require_once("../modeles/compte.php");
	
	session_start();
	
	if (isset($_SESSION["compte"])){
        $c = $_SESSION["compte"];
		$coBd = new Connexion("dbpersbethanie");
		$co = $coBd->connexion();
		
		$result = mysqli_query($co, "SELECT login, mdp FROM compte WHERE id_compte=$c");
									 
		while ($row = mysqli_fetch_assoc($result)){
			$pwd = str_replace("'","''",$row['mdp']);
            $login = str_replace("'","''",$row['login']);
			$m = new Compte($co,$login,$pwd);
			$m->deconnexion();
		}
		
		header('Location: ../vues/connexion.php');
	}
    //header('Location: ../vues/connexion.php');
?>