<?php
    session_start();
    if (empty($_SESSION['compte'])){
        header("Location: ../vues/connexion.php");
    } else {
        $c = $_SESSION['compte'];
    }

    if (empty($_GET['personne'])){
        header("Location: erreur.html");
    } else {
        $m = $_GET['personne'];
    }
    
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

    $result0 = mysqli_query($co,"SELECT * FROM personne WHERE id_personne=$m");
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

    $texte = "Bonjour $sexe $nom $prenom, \r\n\Vous êtes inscrit en tant que membre de l'église réformé de Paris-Béthanie. \r\n\Voici vos coordonnées :\r\n\Date de naissance : $naissance
    \r\n\Numéro de téléphone portable personnel : $tppe
    \r\n\Numéro de téléphone fixe personnel : $tfipe
    \r\n Numéro de téléphone fax personnel : $tfape
    \r\n\Numéro de téléphone portable professionnel : $tppr
    \r\n\Numéro de téléphone fixe professionnel : $tfipr
    \r\n\Numéro de téléphone fax professionnel : $tfapr
    \r\n\Addresse : $addresse
    \r\n\Complément d'adresse : $ca
    \r\n\Code postal : $code
    \r\n\Ville : $ville
    \r\n\Quartier : $quartier
    \r\n\Numéro de boîte ou d'appartement : $boite \r\n\ \r\n\Cordialement, \r\n\ \r\n\ Eglise réformée de Paris-Béthanie \r\n\ 185, rue des Pyrénées \r\n\ 75020, Paris";
    $objet = "Votre inscription à l'église réformée de Paris-Béthanie";
//echo $texte;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Béthanie Membre - Nouveau membre</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" type="image/x-icon" href="../images/icone.ico" />
		<link rel="shortcut icon" type="image/x-icon" href="../images/icone.ico" />
    </head>
    <body>
        <div>
            <img src='../images/logo.png' style='width: 20%'/><br />
            <h1>Membre créé avec succès</h1>
            <?php
                echo "<p>Félicitations, <br /><br /> Vous avez inscrit un nouveau membre $s $nom $prenom. <br /> Un mail vient d'être envoyé à $mel".'.</p>';
            ?>
            <button onclick='location.href = "association.php?personne=<?php echo $m; ?>";'>Ajouter des liens de parenté</button><br />
            <button onclick='location.href = "info_membre.php?personne=<?php echo $m; ?>";'>Terminer</button><br />
        </div>
    </body>
</html>
