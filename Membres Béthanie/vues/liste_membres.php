<?php
    session_start();
    if (empty($_SESSION['compte'])){
        header("Location: ../vues/connexion.php");
    }
    $c = $_SESSION['compte'];
    require_once("../modeles/connexion.php");
    $coBd = new Connexion("dbpersbethanie");
	$co = $coBd->connexion() or die("Erreur de connexion !");
    $r = mysqli_query($co,"SELECT profil_compte from compte where id_compte=$c");
    while ($l = mysqli_fetch_assoc($r)){
        $profil = $l['profil_compte'];
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Béthanie Membre - Liste des membres</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" type="image/x-icon" href="../images/icone.ico" />
		<link rel="shortcut icon" type="image/x-icon" href="../images/icone.ico" />
    </head>
    <body>
        <div>
            <img src='../images/logo.png' style='width: 20%'/><br />
            <h1>Liste des membres inscrits</h1>
            <table>
                <tr>
                    <th style='border: 1px solid #333;'>Nom</th>
                    <th style='border: 1px solid #333;'>Prénom</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php
                    $r = mysqli_query($co, "SELECT count(*) as c FROM personne where statut_personne='Inscrit'");
                    while ($l = mysqli_fetch_assoc($r)){
                        $count = $l['c'];
                    }
                    if ($count != 0){
                        $result = mysqli_query($co, "SELECT id_personne, nom, prenom FROM personne WHERE statut_personne='Inscrit' ORDER BY nom, prenom") or die("<tr><td colspan='2' style='border: 1px solid #333;'>Impossible d'afficher les membres inscrits.</td></tr>");
                        while ($line = mysqli_fetch_assoc($result)) {
                            $nom = $line['nom'];
                            $prenom = $line['prenom'];
                            $p = $line['id_personne'];
                            echo "<tr><td style='border: 1px solid #333;'>$nom</td><td style='border: 1px solid #333;'>$prenom</td><td><button onclick='location.href = ".'"info_membre.php?personne='.$p.'";'."'>Plus d'infos</button></td>";
                            if ($profil == 'Administrateur'){
                                echo "<td><button onclick='desinscrire($p)'>Désinscrire</td>";
                            }
                            echo '</tr>';
                        }
                    } else {
                        echo "<tr><td colspan='2' style='border: 1px solid #333;'>Aucun membre n'est inscrit dans cette église</td></tr>";
                    }
                ?>
            </table><br />
            <button onclick='location.href = "liste_membres_non.php";'>Consulter la liste des membres désinscrits</button><br />
            <?php
                if ($profil == 'Administrateur'){
                    echo "<button onclick='location.href = ".'"formulaire_nouveau_membre.php"'.";'>Nouveau membre</button><br />";
                }
            ?>
            <button onclick='location.href = "menu.php";'>Retour au menu principal</button>
        </div>
        <script>
            function desinscrire(personne){
                var v = confirm("Voulez-vous vraiment désinscrire cette personne ?");

                if (v == true){
                    location.href = "../controleurs/desinscrire_membre.php?personne="+personne;
                }
            }
        </script>
    </body>
</html>