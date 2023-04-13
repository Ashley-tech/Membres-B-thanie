<?php
    require_once('../modeles/connexion.php');
    require_once('../modeles/compte.php');
    session_start();
    $coBd = new Connexion("dbpersbethanie");
    $co = $coBd->connexion() or die ("Erreur de connexion");

    if (!empty($_SESSION['compte'])) {
        $c = $_SESSION['compte'];
    }

    if (!empty($_POST['login'])){
        $login = str_replace("'","''",$_POST['login']);
        $profil = $_POST['profil'];
        $pwd = str_replace("'","''",$_POST['pwd']);

        $r = mysqli_query($co,"SELECT login,mdp,profil_compte FROM compte WHERE id_compte=$c");
        while ($li = mysqli_fetch_assoc($r)){
            $m = str_replace("'","''",$li['mdp']);
            $lo= str_replace("'","''",$li['login']);
            $p = $li['profil_compte'];
        }

        $result = mysqli_query($co,"SELECT count(*) as c FROM compte WHERE login='$login' and id_compte != $c");
        while ($line = mysqli_fetch_assoc($result)){
            $count = $line['c'];
        }

        if ($count != 0){
            header("Location: ../vues/formulaire_modif_compte_info.php?error=2");
        } else {
            if (!empty($_POST['pwd']) || !empty($_POST['pwdr'])){
                if ($_POST['pwd'] != $_POST['pwdr']){
                    header("Location: ../vues/formulaire_modif_compte_info.php?error=1");
                } else {
                    $sql = "UPDATE compte SET login='$login', mdp='$pwd', mdp_crypted = sha1('$pwd'), profil_compte = '$profil' WHERE id_compte = $c";
                }
            } else {
                $sql = "UPDATE compte SET login='$login', profil_compte = '$profil' WHERE id_compte = $c";
            }
            mysqli_query($co,$sql) or die ('Impossible de modifier vos informations');
            if (($lo != $login || $profil != $p) || !empty($_POST['pwd'])){
                mysqli_query($co,"INSERT INTO historiquepersonne (texte,date_historique, heure_historique, supprime, compte_concerne) VALUES ('Vous avez modifié vos informations',curdate(),curtime(),false,$c)");
                header("Location: ../vues/compte_modifie_succes.php");
            } else {
                header("Location: ../vues/info_compte.php");
            }
        }
    } else {
        header("Location: ../vues/formulaire_modif_compte_info.php?error=3");
    }
?>