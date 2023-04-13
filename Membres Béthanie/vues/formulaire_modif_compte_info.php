<?php
    session_start();
    if (empty($_SESSION['compte'])) {
        header('Location: connexion.php');
    } else {
        require_once('../modeles/connexion.php');
        require_once('../modeles/compte.php');

        $c = $_SESSION['compte'];
        $coBd = new Connexion("dbpersbethanie");
        $co = $coBd->connexion() or die ("Erreur de connexion");

        $result = mysqli_query($co,"SELECT login, mdp FROM compte where id_compte = $c");

        while ($line = mysqli_fetch_assoc($result)){
            $login = $line['login'];
            $mdp = $line['mdp'];
        }

        $m = new Compte($co, $login, $mdp);
        $profil = $m->getProfil();
    }
?>
<!DOCTYPE html>
<html style='font-family: Arial; color: #0000ff;'>
    <head>
        <title>Béthanie Membre - Modification de votre compte</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" type="image/x-icon" href="../images/icone.ico" />
		<link rel="shortcut icon" type="image/x-icon" href="../images/icone.ico" />
    </head>
    <body>
        <div class='cadre'>
            <img src='../images/logo.png' style='width: 20%'/>
            <h1>Modification de votre compte</h1>
            <table>
                <form method='post' action='../controleurs/modifier_compte.php'>
                    <tr>
                        <th>Login :*</th>
                        <td><input type='text' name='login' placeholder='Login' value='<?php echo $login; ?>' /></td>
                    </tr>
                    <tr>
                        <th>Nouveau mot de passe :</th>
                        <td><input type='password' name='pwd' placeholder='Nouveau mot de passe' /></td>
                    </tr>
                    <tr>
                        <th>Nouveau mot de passe à reconfirmer :</th>
                        <td><input type='password' name='pwdr' placeholder='Nouveau mot de passe à reconfirmer' /></td>
                    </tr>
                    <tr>
                        <th>Profil :*</th>
                        <td>
                            <select name='profil'>
                                <?php
                                    if ($profil == 'Administrateur'){
                                        echo "<option value='Administrateur'>Administrateur</option><option value='Lecture seule'>Lecture seule</option>";
                                    } else {
                                        echo "<option value='Lecture seule'>Lecture seule</option><option value='Administrateur'>Administrateur</option>";
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input type='submit' value='Modifier' />
                        </td>
                    </tr>
                </form>
                <tr>
                    <th></th>
                    <td>
                        <button onclick='location.href="info_compte.php";'>Retour</button>
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
                            echo '<p style="color: #ff0000">Vous ne pouvez pas donner ce login car un autre compte est encore actif dessus.</p>';
                            break;
                        default:
                            echo '<p style="color: #ff0000">Tous les champs sont obligatoires</p>';
                    }
                 }
            ?>
        </div>
    </body>
</html>