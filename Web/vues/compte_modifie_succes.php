<?php
    session_start();
    if (empty($_SESSION['compte'])){
        header("Location: ../vues/connexion.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Béthanie Membre - Modification de vos informations</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" type="image/x-icon" href="../images/icone.ico" />
		<link rel="shortcut icon" type="image/x-icon" href="../images/icone.ico" />
    </head>
    <body>
        <div>
            <img src='../images/logo.png' style='width: 20%'/><br />
            <h1>Compte modifié avec succès</h1>
            <button onclick='location.href = "info_compte.php"'>Continuer</button><br />
        </div>
    </body>
</html>