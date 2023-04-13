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

    if (!isset($_GET['personne'])){
        header("Location: erreur.html");
    } else {
        $p = $_GET['personne'];
        $result0 = mysqli_query($co, "SELECT * FROM personne WHERE id_personne=$p");
        while ($li = mysqli_fetch_assoc($result0)){
            $sexe = $li['sexe'];
            $nom = $li['nom'];
            $prenom = $li['prenom'];
            $date = $li['date_naissance'];
            $mel = $li['mel'];
            $telfixe = $li['telfixe'];
            $telport = $li['telportable'];
            $telfax = $li['telfax'];
            $telfixep = $li['telfixepro'];
            $telportp = $li['telportablepro'];
            $telfaxp = $li['telfaxpro'];
            $a = $li['adresse'];
            $ac = $li['adresse_comp'];
            $code = $li['cp'];
            $ville = $li['ville'];
            $quartier = $li['quartierville'];
            $boite = $li['numboite_appt'];
            $statut = $li['statut_personne'];
        }

        if ($statut != 'Inscrit'){
            header("Location: liste_memebres.php");
        }
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
            <table style='text-align: left'>
                <form method='post' action='../controleurs/modifier_membre.php?personne=<?php echo $p;?>'>
                    <tr>
                        <th>Sexe :*</th>
                        <td>
                            <select name='sexe'>
                                <?php
                                    if ($sexe == 'M'){
                                        echo "<option value='M'>M.</option><option value='F'>Mme</option>";
                                    } else {
                                        echo "<option value='F'>Mme</option><option value='M'>M.</option>";
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Nom :*</th>
                        <td><input type='text' name='nom' placeholder='Nom' value='<?php echo $nom; ?>' /></td>
                    </tr>
                    <tr>
                        <th>Prénom :*</th>
                        <td><input type='text' name='prenom' placeholder='Prénom' value='<?php echo $prenom; ?>' /></td>
                    </tr>
                    <tr>
                        <th>Date de naissance :*</th>
                        <td>
                            <input type='date' name='naissance'  value='<?php echo $date; ?>'/>
                        </td>
                    </tr>
                    <tr>
                        <th>Mail :</th>
                        <td>
                            <input type='text' name='mel' placeholder='Mail'  value='<?php echo $mel; ?>' />
                        </td>
                    </tr>
                    <tr>
                        <th>Téléphone portable personnel :</th>
                        <td><input type='text' name='telperso' placeholder='Téléphone portable personnel' value='<?php echo $telport; ?>' /></td>
                    </tr>
                    <tr>
                        <th>Téléphone fixe personnel :</th>
                        <td><input type='text' name='telfixeperso' placeholder='Téléphone fixe personnel' value='<?php echo $telfixe; ?>' /></td>
                    </tr>
                    <tr>
                        <th>Téléphone fax personnel :</th>
                        <td><input type='text' name='telfaxperso' placeholder='Téléphone fax personnel' value='<?php echo $telfax; ?>' /></td>
                    </tr>
                    <tr>
                        <th>Téléphone portable professionnel :</th>
                        <td><input type='text' name='telpro' placeholder='Téléphone portable professionnel' value='<?php echo $telportp; ?>' /></td>
                    </tr>
                    <tr>
                        <th>Téléphone fixe professionnel :</th>
                        <td><input type='text' name='telfixepro' placeholder='Téléphone fixe professionnel'  value='<?php echo $telfixep; ?>' /></td>
                    </tr>
                    <tr>
                        <th>Téléphone fax professionnel :</th>
                        <td><input type='text' name='telfaxpro' placeholder='Téléphone fax professionnel'  value='<?php echo $telfaxp; ?>'/></td>
                    </tr>
                    <tr>
                        <th>Adresse :</th>
                        <td><input type='text' name='adresse' placeholder='Adresse' value='<?php echo $a; ?>' /></td>
                    </tr>
                    <tr>
                        <th>Complément d'adresse :</th>
                        <td><input type='text' name='complement' placeholder="Complément d'adresse" value='<?php echo $ac; ?>' /></td>
                    </tr>
                    <tr>
                        <th>Code postal :</th>
                        <td><input type='text' name='cp' placeholder='Code postal' value='<?php echo $code; ?>' /></td>
                    </tr>
                    <tr>
                        <th>Ville :</th>
                        <td><input type='text' name='ville' placeholder='Ville'  value='<?php echo $ville; ?>' /></td>
                    </tr>
                    <tr>
                        <th>Quartier :</th>
                        <td><input type='text' name='quartier' placeholder='Quartier' value='<?php echo $quartier; ?>' /></td>
                    </tr>
                    <tr>
                        <th>Numéro de boite/Numéro d'appartement :</th>
                        <td><input type='text' name='boite' placeholder="Numéro de boîte/numéro d'appartement" value='<?php echo $boite; ?>' /></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <button id='modifier' type='submit' > Modifier la personne </button>
                        </td>
                    </tr>
                </form>
                <tr>
                    <th></th>
                    <td>
                        <button onclick='location.href="info_membre.php?personne="+<?php echo $p;?>;'>Annuler</button>
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