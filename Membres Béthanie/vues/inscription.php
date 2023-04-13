<?php
    session_start();
    if (isset($_SESSION['compte'])) {
        header('Location: menu.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Béthanie Membre - Inscription</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" type="image/x-icon" href="../images/icone.ico" />
		<link rel="shortcut icon" type="image/x-icon" href="../images/icone.ico" />
    </head>
    <body>
        <div class='cadre'>
            <img src='../images/logo.png' style='width: 20%'/>
            <h1>Veuillez vous inscrire en entrant ces champs obligatoires</h1>
            <table>
                <form method='post' action='../controleurs/ajouter_compte.php'>
                    <tr>
                        <th>Login :*</th>
                        <td><input type='text' name='login' placeholder='Login' /></td>
                    </tr>
                    <tr>
                        <th>Mot de passe :*</th>
                        <td><input type='password' name='pwd' placeholder='Mot de passe' /></td>
                    </tr>
                    <tr>
                        <th>Mot de passe à reconfirmer :*</th>
                        <td><input type='password' name='pwdr' placeholder='Mot de passe à reconfirmer' /></td>
                    </tr>
                    <tr>
                        <th>Profil :*</th>
                        <td>
                            <select name='profil'>
                                <option value="">--</option>
                                <option value="Administrateur">Administrateur</option>
                                <option value="Lecture seule">Lecture seule</option>
                            </select>
                        </td>
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
                        <button onclick='location.href = "connexion.php";'>Retour</button>
                    </td>
                </tr>
            </table>
            <?php
                 if (isset($_GET['error'])){
                    switch($_GET['error']){
                        case 1:
                            echo '<p style="color: #ff0000">Les deux mots de passes sont différents.</p>';
                            break;
                        case 2:
                            echo '<p style="color: #ff0000">Le login, que vous avez entré, correspond à un compte encore actif. Veuillez le modifier</p>';
                            break;
                        default:
                            echo '<p style="color: #ff0000">Tous les champs sont obligatoires</p>';
                    }
                 }
            ?>
        </div>
    </body>
</html>