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
        <title>Béthanie Membre - Liste des membres désinscrits</title>
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
                    <th></th>
                </tr>
                <?php
                    $r = mysqli_query($co, "SELECT count(*) as c FROM personne where statut_personne='Désinscrit'");
                    while ($l = mysqli_fetch_assoc($r)){
                        $count = $l['c'];
                    }
                    if ($count != 0){
                        $result = mysqli_query($co, "SELECT id_personne, nom, prenom FROM personne WHERE statut_personne='Désinscrit' ORDER BY nom, prenom") or die("<tr><td colspan='2' style='border: 1px solid #333;'>Impossible d'afficher les membres désinscrits.</td></tr>");
                        while ($line = mysqli_fetch_assoc($result)) {
                            $nom = $line['nom'];
                            $prenom = $line['prenom'];
                            $p = $line['id_personne'];
                            echo "<tr><td style='border: 1px solid #333;'>$nom</td><td style='border: 1px solid #333;'>$prenom</td><td><button onclick='location.href = ".'"info_membre.php?personne='.$p.'";'."'>Plus d'infos</button></td>";
                            if ($profil == 'Administrateur'){
                                echo "<td><button onclick='supp($p)'>Supprimer la personne</td><td><button onclick='reinscrire($p)'>Réinscrire la personne</td>";
                            }
                            echo '</tr>';
                        }
                    } else {
                        echo "<tr><td colspan='2' style='border: 1px solid #333;'>Aucun membre n'a été désinscrit dans cette église</td></tr>";
                    }
                ?>
            </table><br />
            <button onclick='location.href = "liste_membres.php";'>Retourner à la liste des membres inscrits</button>
        </div>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script>
            function supp(personne){
                var v = confirm("Voulez-vous vraiment supprimer cette personne ?");

                if (v == true){
                    $.get(
                        '../controleurs/supprimer_membre.php', //
                        'personne='+personne
                    );
                    location.href = "liste_membres_non.php";
                }
            }

            function reinscrire(personne){
                var v = confirm("Voulez-vous vraiment réinscrire cette personne ?");

                if (v == true){
                    $.get(
                        '../controleurs/reinscrire_membre.php', // Le fichier à appeler sur serveur.
                        'personne='+personne // Spécifier à la méthode qu'aucun paramètre n'est envoyé
                    );
                    location.href = "liste_membres_non.php";
                }
            }
        </script>
    </body>
</html>