<?php
    session_start();
    if (empty($_SESSION['compte'])){
        header("Location: ../vues/connexion.php");
    }
    $c = $_SESSION['compte'];
    require_once("../modeles/connexion.php");
    $coBd = new Connexion("dbpersbethanie");
	$co = $coBd->connexion() or die("Erreur de connexion !");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Béthanie Membre - Historique</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" type="image/x-icon" href="../images/icone.ico" />
		<link rel="shortcut icon" type="image/x-icon" href="../images/icone.ico" />
    </head>
    <body>
        <div>
            <img src='../images/logo.png' style='width: 20%'/><br />
            <h1>Votre historique</h1>
            <table>
                <tr>
                    <th style='border: 1px solid #333;'>Intitulé</th>
                    <th style='border: 1px solid #333;'>Date et heure de l'historique</th>
                    <th style='border: 1px solid #333;'>Membre concerné</th>
                    <th></th>
                </tr>
                <?php
                    $r = mysqli_query($co, "SELECT count(*) as c FROM historiquepersonne join compte on (compte_concerne=id_compte) WHERE compte_concerne=$c AND supprime = false");
                    while ($l = mysqli_fetch_assoc($r)){
                        $count = $l['c'];
                    }
                    if ($count != 0){
                        $result = mysqli_query($co, "SELECT id_historique, texte, date_historique, heure_historique, personne_concerne FROM historiquepersonne join compte on (compte_concerne=id_compte) WHERE compte_concerne=$c AND supprime = false ORDER BY date_historique DESC, heure_historique DESC") or die("<tr><td colspan='3' style='border: 1px solid #333;'>Impossible d'afficher votre historique.</td></tr>");
                        while ($line = mysqli_fetch_assoc($result)) {
                            $historique = $line['id_historique'];
                            $texte = $line['texte'];
                            $date = $line['date_historique'];
                            $heure = $line['heure_historique'];
                            $p = $line['personne_concerne'];
                            echo "<tr><td style='border: 1px solid #333;'>$texte</td><td style='border: 1px solid #333;'>$date - $heure</td><td style='border: 1px solid #333;'>";
                            if ($p != NULL){
                                $result0 = mysqli_query($co, "SELECT sexe, nom, prenom FROM personne where id_personne = $p");
                                while ($l = mysqli_fetch_assoc($result0)){
                                    switch($l['sexe']){
                                        case 'M':
                                            $sexe = 'M.';
                                            break;
                                        default:
                                            $sexe = 'Mme';
                                            break;
                                    }
                                    $nom = $l['nom'];
                                    $prenom = $l['prenom'];
                                }
                                echo $sexe.' '.$nom.' '.$prenom;
                            }
                            //echo "</td><td><button onclick='location.href=".'"confirmation_suppression_historique.php?historique='.$historique.'";'."'>Supprimer</button></td></tr>";
                            echo "</td><td><button onclick='supp($historique)'>Supprimer</button></td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3' style='border: 1px solid #333;'>Votre historique est vide.</td></tr>";
                    }
                ?>
            </table>
            <button onclick='location.href = "menu.php";'>Retour au menu principal</button>
        </div>
        <script>
            function supp(historique){
                var v = confirm("Voulez-vous vraiment supprimer cette historique ?");

                if (v == true){
                    location.href = "../controleurs/supprimer_historique.php?historique="+historique;
                }
            }
        </script>
    </body>
</html>