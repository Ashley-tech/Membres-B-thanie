<?php
    session_start();
    if (isset($_SESSION['compte'])) {
        header('Location: menu.php');
    }
?>
<!DOCTYPE html>
<html style='font-family: Calibri;'>
    <head>
        <title>Béthanie Membre - Connexion</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" type="image/x-icon" href="../images/icone.ico" />
		<link rel="shortcut icon" type="image/x-icon" href="../images/icone.ico" />
    </head>
    <body style='color:black;background-color:white;background-image:url(../images/Église_réformée_de_Paris_Béthanie_2021_1.jpg);background-size: 1550px 760px;background-attachment: fixed;'>
        <div style='border: 10px solid #0A4;
		border-color: rgb(225, 225, 225);
		padding: 15px;
		width: 490px;
		display: block;
		margin: 0 auto;
		background: rgba(255,255,255);
		box-shadow: 0 5px 15px rgba(0,0,0,.5);
		text-align: center;
        display: grid;
        border-radius: 20px;
		height: 70vh;
		place-items: center;
        top: 50%;
        left: 50%;
		position: absolute;
		transform: translate(-50%,-50%);'>
            <img src='../images/logo.png' style='width: 60%'/>
            <h1 style='color: #0000ff;'>Connexion</h1>
            <table style='text-align: left'>
                <form method='post' action='../controleurs/connexion.php'>
                    <tr>
                        <th style='color: #0000ff;'>Login :</th>
                        <td><input type='text' name='login' placeholder='Login' /></td>
                    </tr>
                    <tr>
                        <th style='color: #0000ff;'>Mot de passe :</th>
                        <td>
                            <input type='password' name='pwd' placeholder='Mot de passe' />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><a href='login.php'>Mot de passe oublié ?</a></td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <button type='submit' style='background-color: yellow; border-radius: 20px;color: #0000FF; font-family: Calibri; width: 100%;font-size:29px;'>Se connecter</button>
                        </td>
                    </tr>
                </form>
                <tr>
                    <td colspan='2'>
                        <button onclick='location.href="inscription.php";' style='border-radius: 20px;background-color: yellow; font-size:29px;color: #0000FF; font-family: Calibri; width: 100%;'>Inscription</button>
                    </td>
                </tr>
            </table>
            <?php
                 if (isset($_GET['error'])){
                    switch ($_GET['error']){
                        case 1:
                            echo '<p style="color: #ff0000">Malheureusement, ce compte a été supprimé</p>';
                            break;
                        default:
                            echo '<p style="color: #ff0000">Les informations entrées ne correspondent à aucun compte !</p>';
                            break;
                    }
                 }
            ?>
        </div>
    <footer style='display: flex;
    justify-content: right;
    padding: 10px;
    background-color: #ffff00;bottom: 0;left:0;right:0;position:absolute;height:50px;
    color: black;'>
        <p>Eglise réformée de Paris Béthanie<br />Copyright © 2023 Ashley RAKOTOARISOA</p>
    </footer>
    </body>
</html>