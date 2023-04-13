<?php
	require_once("../modeles/connexion.php");
	require_once("../modeles/compte.php");
	
	if (!empty($_POST["login"])){
		$login = str_replace("'","''",$_POST['login']);
		
		$coBd = new Connexion("dbpersbethanie");
		$co = $coBd->connexion() or die("Erreur de connexion !");
		
		$result = mysqli_query($co, "SELECT count(*) as count, statut_compte, mdp FROM compte WHERE login='$login'") or die("Erreur requête");
        while ($line = mysqli_fetch_assoc($result)) {
            $count = $line['count'];
            $statut = $line['statut_compte'];
            $pwd = $line['mdp'];
        }
 
		if ($count == 1 && $statut != 'Supprimé') {
            $m = new Compte($co,$login,$pwd);
            $m->connexion();
            header('Location:../vues/new_pwd.php');
		}else{
			header('Location:../vues/login.php?error=1');
		}
	} else {
        header('Location:../vues/login.php?error=2');
    }
?>