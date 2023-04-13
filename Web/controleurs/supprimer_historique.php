<?php
    require_once('../modeles/connexion.php');

    $coBd = new Connexion("dbpersbethanie");
    $co = $coBd->connexion();

    if (!empty($_GET['historique'])){
        $h = $_GET['historique'];
        mysqli_query($co,"UPDATE historiquepersonne SET supprime=true WHERE id_historique = $h");
        header("Location: ../vues/historique.php");
    } else {
        header("Location: ../vues/erreur.html");
    }

?>