<?php
    session_start();
    if (empty($_SESSION['compte'])){
        header("Location: ../vues/connexion.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Béthanie Membre - Voulez-vous supprimer votre compte ?</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" type="image/x-icon" href="../images/icone.ico" />
		<link rel="shortcut icon" type="image/x-icon" href="../images/icone.ico" />
    </head>
    <body>
        <div>
            <img src='../images/logo.png' style='width: 20%'/><br />
            <h2>Êtes-vous sûr de vouloir supprimer votre compte ? <i>(Si OUI, vous serez déconnecté et vous ne pourrez plus accéder à ce compte)</i></h2>
            <button onclick='location.href = "../controleurs/supprimer_compte.php"'>Oui</button><br />
            <button onclick='window.history.back();'>Non</button>
        </div>
    </body>
</html>