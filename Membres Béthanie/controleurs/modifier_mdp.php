<?php
    require_once('../modeles/compte.php');
    require_once('../modeles/connexion.php');

    session_start();
    $c = $_SESSION['compte'];

    $coBd = new Connexion("dbpersbethanie");
	$co = $coBd->connexion() or die("Erreur de connexion !");

    $result = mysqli_query($co, "SELECT login FROM compte WHERE id_compte=$c");
    while($line = mysqli_fetch_assoc($result)){
        $login = $line['login'];
    }

    if (!empty($_POST['pwd']) && !empty($_POST['pwdr'])){
        if ($_POST['pwd'] != $_POST['pwdr']){
            header("Location: ../vues/new_pwd.php?error=2");
        } else {
            $pwd = str_replace("'","''",$_POST['pwd']);

            mysqli_query($co, "UPDATE compte SET mdp='$pwd', mdp_crypted=sha1('$pwd') WHERE id_compte=$c") or die ("Erreur de modification du mot de passe");

            mysqli_query($co, "INSERT INTO historiquepersonne (texte, date_historique, heure_historique, supprime, compte_concerne) VALUES ('Vous avez modifié votre mot de passe',curdate(), curtime(), false, $c)");

            header("Location: ../vues/pwd_updated_success.php");
        }
    } else {
        header("Location: ../vues/new_pwd.php?error=1");
    }
?>