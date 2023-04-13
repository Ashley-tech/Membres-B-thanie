<?php
    session_start();
    if (isset($_SESSION['compte'])) {
        header('Location: menu.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Béthanie Membre - Mot de passe oublié</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" type="image/x-icon" href="../images/icone.ico" />
		<link rel="shortcut icon" type="image/x-icon" href="../images/icone.ico" />
    </head>
    <body>
        <div>
            <img src='../images/logo.png' style='width: 20%'/>
            <h1>Mot de passe oublié</h1>
            <table>
                <form method='post' action='../controleurs/verif_login.php'>
                    <tr>
                        <th>Login :</th>
                        <td><input type='text' name='login' placeholder='Login' /></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <button type='submit'>Valider</button>
                        </td>
                    </tr>
                </form>
                <tr>
                    <th></th>
                    <td>
                        <button onclick='location.href="connexion.php";'>Retour</button>
                    </td>
                </tr>
            </table>
            <?php
                 if (isset($_GET['error'])){
                    switch ($_GET['error']) {
                        case 1:
                            echo "<p style='color: #ff0000'>Il n'existe pas de compte avec ce login.</p>";
                            break;
                        default:
                            echo "<p style='color: #ff0000'>Veuillez impérativement saisir un login</p>";
                            break;
                    }
                 }
            ?>
        </div>
    </body>
</html>