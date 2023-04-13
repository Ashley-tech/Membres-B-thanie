<?php
    session_start();
    require_once("../modeles/connexion.php");
	require_once("../modeles/compte.php");
    $coBd = new Connexion("dbpersbethanie");
	$co = $coBd->connexion() or die("Erreur de connexion !");
    if (isset($_SESSION['compte'])){
        $c = $_SESSION['compte'];
        $p = $_GET['personne'];

        mysqli_query($co, "UPDATE personne SET statut_personne='Désinscrit' WHERE id_personne = $p");
        mysqli_query($co, "INSERT INTO historiquepersonne (texte, date_historique, heure_historique, supprime, personne_concerne, compte_concerne) VALUES ('Vous avez désinscrit une personne',curdate(),curtime(),false, $p,$c)");
        header("Location: ../vues/liste_membres.php");
    }
?>