<?php
    session_start();
    if (empty($_SESSION['compte'])) {
        header('Location: connexion.php');
    } else {
        
    }
    $c = $_SESSION['compte'];
    require_once("../modeles/connexion.php");
    $coBd = new Connexion("dbpersbethanie");
	$co = $coBd->connexion() or die("Erreur de connexion !");
    $result = mysqli_query($co, "SELECT profil_compte from compte WHERE id_compte=$c");
    while($l = mysqli_fetch_assoc($result)){
        $profil = $l['profil_compte'];
    }
    if ($profil == 'Lecture seule'){
        header('Location: liste_membres.php');
    }
?>
<!DOCTYPE html>
<html style='font-family: Calibri; color: #0000ff;'>
    <head>
        <title>Béthanie Membre - Nouveau membre</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" type="image/x-icon" href="../images/icone.ico" />
		<link rel="shortcut icon" type="image/x-icon" href="../images/icone.ico" />
    </head>
    <body>
        <div class='cadre'>
            <img src='../images/logo.png' style='width: 20%'/>
            <h1>Création d'un nouveau membre</h1>
            <table>
                <form method='post' action='../controleurs/ajouter_membre.php'>
                    <tr>
                        <th>Sexe :*</th>
                        <td>
                            <select name='sexe'>
                                <option value="">--</option>
                                <option value="M">M.</option>
                                <option value="F">Mme</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Nom :*</th>
                        <td><input type='text' name='nom' placeholder='Nom' /></td>
                    </tr>
                    <tr>
                        <th>Prénom :*</th>
                        <td><input type='text' name='prenom' placeholder='Prénom' /></td>
                    </tr>
                    <tr>
                        <th>Date de naissance :*</th>
                        <td>
                            <input type='date' name='naissance' />
                        </td>
                    </tr>
                    <tr>
                        <th>Mail :</th>
                        <td>
                            <input type='text' name='mel' placeholder='Mail' />
                        </td>
                    </tr>
                    <tr>
                        <th>Téléphone portable personnel :</th>
                        <td><input type='text' name='telperso' placeholder='Téléphone portable personnel' /></td>
                    </tr>
                    <tr>
                        <th>Téléphone fixe personnel :</th>
                        <td><input type='text' name='telfixeperso' placeholder='Téléphone fixe personnel' /></td>
                    </tr>
                    <tr>
                        <th>Téléphone fax personnel :</th>
                        <td><input type='text' name='telfaxperso' placeholder='Téléphone fax personnel' /></td>
                    </tr>
                    <tr>
                        <th>Téléphone portable professionnel :</th>
                        <td><input type='text' name='telpro' placeholder='Téléphone portable professionnel' /></td>
                    </tr>
                    <tr>
                        <th>Téléphone fixe professionnel :</th>
                        <td><input type='text' name='telfixepro' placeholder='Téléphone fixe professionnel' /></td>
                    </tr>
                    <tr>
                        <th>Téléphone fax professionnel :</th>
                        <td><input type='text' name='telfaxpro' placeholder='Téléphone fax professionnel' /></td>
                    </tr>
                    <tr>
                        <th>Adresse :</th>
                        <td><input type='text' name='adresse' placeholder='Addresse' /></td>
                    </tr>
                    <tr>
                        <th>Complément d'adresse :</th>
                        <td><input type='text' name='complement' placeholder="Complément d'adresse" /></td>
                    </tr>
                    <tr>
                        <th>Code postal :</th>
                        <td><input type='text' name='cp' placeholder='Code postal' /></td>
                    </tr>
                    <tr>
                        <th>Ville :</th>
                        <td><input type='text' name='ville' placeholder='Ville' /></td>
                    </tr>
                    <tr>
                        <th>Quartier :</th>
                        <td><input type='text' name='quartier' placeholder='Quartier' /></td>
                    </tr>
                    <tr>
                        <th>Numéro de boite/Numéro d'appartement :</th>
                        <td><input type='text' name='boite' placeholder="Numéro de boîte/numéro d'appartement" /></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input type='submit' value='Ajouter la personne' />
                        </td>
                    </tr>
                </form>
                <tr>
                    <th></th>
                    <td>
                        <button onclick='location.href="liste_membres.php"'>Annuler</button>
                    </td>
                </tr>
            </table>
            <?php
                 if (isset($_GET['error'])){
                    switch($_GET['error']){
                        case 1:
                            echo "<p style='color: #ff0000'>Veuillez saisir correctement l'adresse mail</p>";
                            break;
                        case 2:
                            echo '<p style="color: #ff0000">Le numéro de téléphone portable personnel doit commencer par un zéro et ne doit comporter que des chiffres</p>';
                            break;
                        case 3:
                            echo '<p style="color: #ff0000">Le numéro de téléphone fixe personnel doit commencer par un zéro et ne doit comporter que des chiffres</p>';
                            break;
                        case 4:
                            echo '<p style="color: #ff0000">Le numéro de téléphone fax personnel doit commencer par un zéro et ne doit comporter que des chiffres</p>';
                            break;
                        case 5:
                            echo '<p style="color: #ff0000">Le numéro de téléphone portable professionnel doit commencer par un zéro et ne doit comporter que des chiffres</p>';
                            break;
                        case 6:
                            echo '<p style="color: #ff0000">Le numéro de téléphone fixe professionnel doit commencer par un zéro et ne doit comporter que des chiffres</p>';
                            break;
                        case 7:
                            echo '<p style="color: #ff0000">Le numéro de téléphone fax professionnel doit commencer par un zéro et ne doit comporter que des chiffres</p>';
                            break;
                        case 8:
                            echo '<p style="color: #ff0000">Le code postal ne doit être constitué que de chiffres</p>';
                            break;
                        default:
                            echo '<p style="color: #ff0000">Veuillez impérativement renseigner le sexe, le nom, le prénom et la date de naissance.</p>';
                            break;
                    }
                 }
            ?>
        </div>
    </body>
</html>