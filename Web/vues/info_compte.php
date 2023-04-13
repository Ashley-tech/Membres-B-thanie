<?php
    session_start();
    if (empty($_SESSION['compte'])){
        header("Location: ../vues/connexion.php");
    }
    $compte =$_SESSION['compte'];
    require_once('../modeles/connexion.php');
    $coBd = new Connexion("dbpersbethanie");
	$co = $coBd->connexion() or die("Erreur de connexion !");
    $result = mysqli_query($co, "SELECT login, mdp, profil_compte, date_creation, heure_creation FROM compte WHERE id_compte = $compte");
    while ($line = mysqli_fetch_assoc($result)){
        $login = $line['login'];
        $mdp = strlen($line['mdp']);
        $profil = $line['profil_compte'];
        $date = $line['date_creation'];
        $heure = $line['heure_creation'];
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Béthanie Membre - Information sur votre compte</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" type="image/x-icon" href="../images/icone.ico" />
		<link rel="shortcut icon" type="image/x-icon" href="../images/icone.ico" />
    </head>
    <body>
        <div>
            <img src='../images/logo.png' style='width: 20%'/><br />
            <h1>Vos informations</h1>
            <p>
                <b>Login : </b><?php echo $login; ?><br />
                <b>Mot de passe : </b>
                <?php
                    $m = '';
                    for ($i=0; $i<$mdp; $i++) {
                        $m.='*';
                    }
                    echo $m;
                ?><br />
                <?php 
                    echo "Compte créé le $date à $heure";
                ?><br />
                <b>Profil : </b><?php echo $profil; ?><br />
            </p>
            <button onclick='location.href = "formulaire_modif_compte_info.php";'>Modifier vos informations</button><br />
            <button onclick='location.href = "menu.php";'>Retour au menu principal</button>
        </div>
    </body>
</html>