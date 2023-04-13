<?php
	require_once("../modeles/connexion.php");
	require_once("../modeles/compte.php");
	
	if (isset($_POST["login"]) && isset($_POST["pwd"])){
		$login = str_replace("'","''",$_POST['login']);
		$pwd= str_replace("'","''",$_POST['pwd']);
		
		$coBd = new Connexion("dbpersbethanie");
		$co = $coBd->connexion() or die("Erreur de connexion !");
		
		$result = mysqli_query($co, "SELECT count(*) as count, statut_compte FROM compte WHERE login='$login' AND mdp_crypted=sha1('$pwd')") or die("Erreur requête");
        while ($line = mysqli_fetch_assoc($result)) {
            $count = $line['count'];
            $statut = $line['statut_compte'];
        }

			   
		if ($count == 1) {
            if ($statut == 'Supprimé') {
                header('Location: ../vues/connexion.php?error=1');
            } else {
                $m = new Compte($co,$login,$pwd);
                $m->connexion();
                header('Location:../vues/menu.php');
            }
		}else{
			header('Location:../vues/connexion.php?error=2');
		}
	}
?>