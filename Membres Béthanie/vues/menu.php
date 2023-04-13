<?php
    session_start();
    if (empty($_SESSION['compte'])){
        header("Location: ../vues/connexion.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Béthanie Membre - Menu principal</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" type="image/x-icon" href="../images/icone.ico" />
		<link rel="shortcut icon" type="image/x-icon" href="../images/icone.ico" />
    </head>
    <body>
        <div>
            <img src='../images/logo.png' style='width: 20%'/><br />
            <button onclick='location.href = "liste_membres.php"'>Membres</button><br />
            <button onclick='location.href = "info_compte.php"'>Vos informations</button><br />
            <button onclick='location.href = "historique.php"'>Votre historique</button><br />
            <button onclick='location.href = "confirmation_suppression_compte.php"'>Supprimer votre compte</button><br />
            <button onclick='location.href = "../controleurs/deconnexion.php"'>Se déconnecter</button><br />
        </div>
    </body>
</html>