<?php
    session_start();
    if (empty($_SESSION['compte'])){
        header("Location: ../vues/connexion.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Béthanie Membres</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" type="image/x-icon" href="../images/icone.ico" />
		<link rel="shortcut icon" type="image/x-icon" href="../images/icone.ico" />
    </head>
    <body>
        <div>
            <img src='../images/logo.png' />
            <h1>Bienvenue dans la gestion des membres de l'église réformée de Paris-Béthanie</h1>
            <button onclick='location.href="menu.php";'>Suite</button>
        </div>
    </body>
</html>