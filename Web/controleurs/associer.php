<?php
    require_once('../modeles/connexion.php');
    require_once('../modeles/compte.php');

    session_start();

    if (isset($_SESSION['compte'])){
        $c = $_SESSION['compte'];
    }

    $coBd = new Connexion("dbpersbethanie");
    $co = $coBd->connexion();
    $p = $_GET['personne'];
    $liens = $_POST['liens'];

    mysqli_query($co, "DELETE from lienpersonne WHERE personne = $p");
    foreach ($liens as $lien){
        mysqli_query($co, "INSERT INTO lienpersonne VALUES ($lien,$p)");
    }
    mysqli_query($co, "INSERT INTO historiquepersonne (texte, date_historique, heure_historique, supprime, personne_concerne, compte_concerne) VALUES ('Vous avez attribué de nouveaux liens de parenté à cette personne',curdate(),curtime(),false,$p,$c)");
    header("Location: ../vues/info_membre.php?personne=$p");
?>