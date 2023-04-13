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
    
    $result0 = mysqli_query($co,"SELECT sexe, nom, prenom, statut_personne FROM personne WHERE id_personne=$p");
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
        $statut = $line['statut_personne'];
    }

    if ($statut != 'Inscrit' || $profil == 'Lecture seule') {
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
            <form method='post' action='../controleurs/associer.php?personne=<?php echo $p; ?>'>
                <ul>
                    <?php
                        if ($sexe == 'F'){
                            $sql = "SELECT id_lien,libelle FROM lienparente WHERE sexe_particulier != 'M' ORDER BY libelle";
                        } else {
                            $sql = "SELECT id_lien,libelle FROM lienparente WHERE sexe_particulier != 'F' ORDER BY libelle";
                        }
                        $result1 = mysqli_query($co,$sql);
                        while ($row = mysqli_fetch_assoc($result1)){
                            $lien = $row['id_lien'];
                            $result2 = mysqli_query($co,"SELECT count(*) as c FROM lienpersonne where lien=$lien AND personne=$p");
                            while ($l1 = mysqli_fetch_assoc($result2)){
                                $c = $l1['c'];
                            }
                            if ($c == 1){
                                echo "<input type='checkbox' name='liens[]' value='$lien' checked>".$row['libelle']."</input><br />";
                            } else {
                                echo "<input type='checkbox' name='liens[]' value='$lien'>".$row['libelle']."</input><br />";
                            }
                        }
                    ?>
                </ul>
                <button type='submit'>Valider</button>
            </form>
            <button onclick='location.href = "info_membre.php?personne=<?php echo $p; ?>";'>Retour</button>
        </div>
    </body>
</html>