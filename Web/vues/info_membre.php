<?php
    session_start();
    if (empty($_SESSION['compte'])) {
        header('Location: connexion.php');
    }
    $c = $_SESSION['compte'];

    require_once("../modeles/connexion.php");
    $coBd = new Connexion("dbpersbethanie");
	$co = $coBd->connexion() or die("Erreur de connexion !");
    if (empty($_GET['personne'])){
        header('Location: erreur.html');
    } else {
        $p = $_GET['personne'];
    }

    $result = mysqli_query($co, "SELECT profil_compte from compte WHERE id_compte=$c");
    while($l = mysqli_fetch_assoc($result)){
        $profil = $l['profil_compte'];
    }
    
    $result0 = mysqli_query($co,"SELECT * FROM personne WHERE id_personne=$p");
    while ($line = mysqli_fetch_assoc($result0)){
        $sexe = $line['sexe'];
        switch($line['sexe']){
            case 'F':
                $s = 'Mme';
                break;
            default:
                $s = 'M.';
                break;
        }
        $nom = $line['nom'];
        $prenom = $line['prenom'];
        $naissance = $line['date_naissance'];
        $mel = $line['mel'];
        $tppe = $line['telportable'];
        $tfipe = $line['telfixe'];
        $tfape = $line['telfax'];
        $tppr = $line['telportablepro'];
        $tfipr = $line['telfixepro'];
        $tfapr = $line['telfaxpro'];
        $addresse = $line['adresse'];
        $ca = $line['adresse_comp'];
        $code = $line['cp'];
        $ville = $line['ville'];
        $quartier = $line['quartierville'];
        $boite = $line['numboite_appt'];
        $statut = $line['statut_personne'];
    }

    if ($statut == 'Supprimé') {
        header("Location: liste_membres.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Béthanie Membres - Association des liens</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" type="image/x-icon" href="../images/icone.ico" />
		<link rel="shortcut icon" type="image/x-icon" href="../images/icone.ico" />
    </head>
    <body>
        <div>
            <img src='../images/logo.png' style='width: 20%'/>
            <h1>Association des liens de parents pour <?php echo $s.' '.strtoupper($nom).' '.$prenom; ?></h1>
            <table>
            <?php
                echo "<tr><th style='text-align: left'>Date de naissance : </th><td>$naissance</td></tr>";
                echo "<tr><th style='text-align: left'>Mail : </th>";
                if (!empty($mel)){
                    echo '<td>'.$mel.'</td></tr>';
                } else {
                    echo "<td><i>(Non renseigné)</i></td></tr>";
                }
                echo "<tr><th style='text-align: left'>Téléphone portable personnel : </th>";
                if (!empty($tppe)){
                    echo '<td>'.$tppe.'</td></tr>';
                } else {
                    echo "<td><i>(Non renseigné)</i></td></tr>";
                }
                echo "<tr><th style='text-align: left'>Téléphone fixe personnel : </th>";
                if (!empty($tfipe)){
                    echo '<td>'.$tfipe.'</td></tr>';
                } else {
                    echo "<td><i>(Non renseigné)</i></td></tr>";
                }
                echo "<tr><th style='text-align: left'>Téléphone fax personnel : </th>";
                if (!empty($tfape)){
                    echo '<td>'.$tfape.'</td></tr>';
                } else {
                    echo "<td><i>(Non renseigné)</i></td></tr>";
                }
                echo "<tr><th style='text-align: left'>Téléphone portable professionnel : </th>";
                if (!empty($tppr)){
                    echo '<td>'.$tppr.'</td></tr>';
                } else {
                    echo "<td><i>(Non renseigné)</i></td></tr>";
                }
                echo "<tr><th style='text-align: left'>Téléphone fixe professionnel : </th>";
                if (!empty($tfipr)){
                    echo '<td>'.$tfipr.'</td></tr>';
                } else {
                    echo "<td><i>(Non renseigné)</i></td></tr>";
                }
                echo "<tr><th style='text-align: left'>Téléphone fax professionnel : </th>";
                if (!empty($tfapr)){
                    echo '<td>'.$tfapr.'</td></tr>';
                } else {
                    echo "<td><i>(Non renseigné)</i></td></tr>";
                }
                echo "<tr><th style='text-align: left'>Adresse : </th>";
                if (!empty($addresse)){
                    echo '<td>'.$addresse.'</td></tr>';
                } else {
                    echo "<td><i>(Non renseigné)</i></td></tr>";
                }
                echo "<tr><th style='text-align: left'>Complément d'adresse : </th>";
                if (!empty($ca)){
                    echo '<td>'.$ca.'</td></tr>';
                } else {
                    echo "<td><i>(Non renseigné)</i></td></tr>";
                }
                echo "<tr><th style='text-align: left'>Code postal : </th>";
                if (!empty($code)){
                    echo '<td>'.$code.'</td></tr>';
                } else {
                    echo "<td><i>(Non renseigné)</i></td></tr>";
                }
                echo "<tr><th style='text-align: left'>Ville : </th>";
                if (!empty($ville)){
                    echo '<td>'.$ville.'</td></tr>';
                } else {
                    echo "<td><i>(Non renseigné)</i></td></tr>";
                }
                echo "<tr><th style='text-align: left'>Quartier : </th>";
                if (!empty($quartier)){
                    echo '<td>'.$quartier.'</td></tr>';
                } else {
                    echo "<td><i>(Non renseigné)</i></td></tr>";
                }
                echo "<tr><th style='text-align: left'>Numéro de boite/Numéro d'appartement : </th>";
                if (!empty($boite)){
                    echo '<td>'.$boite.'</td></tr>';
                } else {
                    echo "<td><i>(Non renseigné)</i></td></tr>";
                }
                if ($statut == 'Inscrit'){
            ?>
            </table>
            <?php
                $result1 = mysqli_query($co, "SELECT count(*) as c FROM lienpersonne JOIN lienparente ON (lien = id_lien) WHERE personne=$p");
                while ($r = mysqli_fetch_assoc($result1)) {
                    $c = $r['c'];
                }
                if ($c == 0){
                    echo '<ul>Pas de liens de parenté';
                } else {
            ?>
            <ul><b>Liens de parenté :</b>
            <?php
                    $result2 = mysqli_query($co, "SELECT libelle FROM lienpersonne JOIN lienparente ON (lien = id_lien) WHERE personne=$p ORDER BY libelle");
                    while ($row = mysqli_fetch_assoc($result2)) {
                        echo '<li>'.$row['libelle'].'</li>';
                    }
                }
            ?>
            </ul>
            <?php
                if ($profil == 'Administrateur'){
                    echo "<button onclick='location.href=".'"formulaire_modif_pers.php?personne='.$p.'";'."'>Modifier les informations</button><br />";
                    echo "<button onclick='location.href=".'"association.php?personne='.$p.'";'."'>Modifier les liens</button><br />";
                }
            ?>
            <button onclick='location.href = "liste_membres.php";'>Retour</button>
            <?php
                }else if ($statut == 'Désinscrit') {
            ?>
            <button onclick='location.href = "liste_membres_non.php";'>Retour</button>
            <?php } ?>
        </div>
    </body>
</html>