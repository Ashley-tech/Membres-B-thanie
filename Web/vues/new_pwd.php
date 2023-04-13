<?php
    session_start();
    if (empty($_SESSION['compte'])){
        header("Location: ../vues/connexion.php");
    } else {
        $c = $_SESSION['compte'];
    }

    require_once('../modeles/connexion.php');

    $coBd = new Connexion("dbpersbethanie");
	$co = $coBd->connexion() or die("Erreur de connexion !");

    $result = mysqli_query($co,"SELECT login FROM compte where id_compte=$c");

    while ($line = mysqli_fetch_assoc($result)){
        $login = $line['login'];
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
                <form method='post' action='../controleurs/modifier_mdp.php'>
                    <tr>
                        <th>Login :</th>
                        <td>
                            <?php
                                echo $login;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Nouveau mot de passe :*</th>
                        <td><input type='password' name='pwd' placeholder='Mot de passe' /></td>
                    </tr>
                    <tr>
                        <th>Mot de passe à reconfirmer :*</th>
                        <td><input type='password' name='pwdr' placeholder='Mot de passe à reconfirmer' /></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <button type='submit'>Modifier</button>
                        </td>
                    </tr>
                </form>
                <tr>
                    <th></th>
                    <td>
                        <button onclick='location.href = "../controleurs/deconnexion.php";'>Retour</button>
                    </td>
                </tr>
            </table>
            <?php
                 if (isset($_GET['error'])){
                    switch ($_GET['error']){
                        case 1:
                            echo '<p style="color: #ff0000">Les 2 champs sont obligatoires</p>';
                            break;
                        case 2:
                            echo '<p style="color: #ff0000">Les deux mots de passes sont différents</p>';
                            break;
                    }
                 }
            ?>
        </div>
    </body>
</html>