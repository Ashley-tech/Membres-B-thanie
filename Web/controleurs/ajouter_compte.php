<?php
	require_once("../modeles/connexion.php");
	require_once("../modeles/compte.php");
	
	if (!empty($_POST["login"]) && !empty($_POST["pwd"]) && !empty($_POST["pwdr"]) && !empty($_POST["profil"])){
		$login = str_replace("'","''",$_POST["login"]);
        if ($_POST["pwd"] != $_POST["pwdr"]){
            header('Location: ../vues/inscription.php?error=1');
        } else {
            $pwd= str_replace("'","''",$_POST["pwd"]);
		    $profil= $_POST["profil"];
		
		    $coBd = new Connexion("dbpersbethanie");
		    $co = $coBd->connexion();
            $result = mysqli_query($co, "SELECT count(*) as count, statut_compte FROM compte WHERE login='$login'") or die("Erreur requête");
            while ($line = mysqli_fetch_assoc($result)) {
                $count = $line['count'];
                $statut = $line['statut_compte'];
            }

            if ($count == 1 && $statut != 'Supprimé') {
                header('Location: ../vues/inscription.php?error=2');
            }else{
                $m = new Compte($co,$login,$pwd,$profil);
                $m->connexion();
                
                header('Location:../vues/bienvenue.php');
            }
        }
	} else {
        header('Location: ../vues/inscription.php?error=3');
    }
?>