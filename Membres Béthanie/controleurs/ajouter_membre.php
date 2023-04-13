<?php
    require_once('../modeles/connexion.php');
    require_once('../modeles/compte.php');
    session_start();
    $coBd = new Connexion("dbpersbethanie");
    $co = $coBd->connexion() or die ("Erreur de connexion");
    
    if (!empty($_SESSION['compte'])) {
        $c = $_SESSION['compte'];
    }

    if (!empty($_POST['sexe']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['naissance'])){
        $sexe = $_POST['sexe'];
        $nom = str_replace("'","''",ucfirst(strtolower($_POST['nom'])));
        $prenom = str_replace("'","''",ucfirst(strtolower($_POST['prenom'])));
        $date = $_POST['naissance'];
        $regexm = "/^([a-zA-Z0-9\.\_\-]+@+[a-zA-Z-]+(\.)+[a-zA-Z]{2,3})$/";

        if (!empty($_POST['mel'] && !preg_match($regexm,$_POST['mel']))) {
            header("Location: ../vues/formulaire_nouveau_membre.php?error=1");
        } else {
            if (!empty($_POST['mel'])) {
                $mel = "'".$_POST['mel']."'";
            } else {
                $mel = "NULL";
            }
            

            $regext = "#[0-9]#";
            $portperso = $_POST['telperso'];
            $fixeperso = $_POST['telfixeperso'];
            $faxperso = $_POST['telfaxperso'];
            $portpro = $_POST['telpro'];
            $faxpro = $_POST['telfaxpro'];
            $fixepro = $_POST['telfixepro'];

            if (!empty($portperso) && ($portperso[0] != '0' || !preg_match($regext,$portperso))) {
                header("Location: ../vues/formulaire_nouveau_membre.php?error=2");
            } else {
                if (!empty($portperso)) {
                    $portperso = "'$portperso'";
                } else {
                    $portperso = "NULL";
                }

                if (!empty($fixeperso) && ($fixeperso[0] != '0' || !preg_match($regext,$fixeperso))){
                    header("Location: ../vues/formulaire_nouveau_membre.php?error=3");
                } else {
                    if (!empty($fixeperso)) {
                        $fixeperso = "'$fixeperso'";
                    } else {
                        $fixeperso = "NULL";
                    }

                    if (!empty($faxperso) && ($faxperso[0] != '0' || !preg_match($regext,$faxperso))) {
                        header("Location: ../vues/formulaire_nouveau_membre.php?error=4");
                    } else {
                        if (!empty($faxperso)) {
                            $faxperso = "'$faxperso'";
                        } else {
                            $faxperso = "NULL";
                        }

                        if (!empty($portpro) && ($portpro[0] != '0' || !preg_match($regext,$portpro))){
                            header("Location: ../vues/formulaire_nouveau_membre.php?error=5");
                        } else {
                            if (!empty($portpro)) {
                                $portpro = "'$portpro'";
                            } else {
                                $portpro = "NULL";
                            }

                            if (!empty($fixepro) && ($fixepro[0] != '0' || !preg_match($regext,$fixepro))){
                                header("Location: ../vues/formulaire_nouveau_membre.php?error=6");
                            } else{
                                if (!empty($fixepro)) {
                                    $fixepro = "'$fixepro'";
                                } else {
                                    $fixepro = "NULL";
                                }

                                if (!empty($faxpro) && ($faxpro[0] != '0' || !preg_match($regext,$faxpro))){
                                    header("Location: ../vues/formulaire_nouveau_membre.php?error=7");
                                } else {
                                    if (!empty($fixepro)) {
                                        $faxpro = "'$faxpro'";
                                    } else {
                                        $faxpro = "NULL";
                                    }

                                    if (!empty($_POST['adresse'])){
                                        $adresse = "'".str_replace("'","''",$_POST['adresse'])."'";
                                    } else {
                                        $adresse = "NULL";
                                    }

                                    if (!empty($_POST['complement'])){
                                        $cadresse = "'".str_replace("'","''",$_POST['complement'])."'";
                                    } else {
                                        $cadresse = "NULL";
                                    }

                                    if (!empty($_POST['cp']) && !preg_match($regext,$_POST['cp'])) {
                                         header("Location: ../vues/formulaire_nouveau_membre.php?error=8");
                                    } else {
                                        if (!empty($_POST['cp'])){
                                            $cp = "'".str_replace("'","''",$_POST['cp'])."'";
                                        } else {
                                            $cp = 'NULL';
                                        }

                                        if (!empty($_POST['ville'])){
                                            $ville = "'".str_replace("'","''",$_POST['ville'])."'";
                                        } else {
                                            $ville = 'NULL';
                                        }

                                        if (!empty($_POST['quartier'])){
                                            $qv = "'".str_replace("'","''",$_POST['quartier'])."'";
                                        } else {
                                            $qv = 'NULL';
                                        }

                                        if (!empty($_POST['boite'])) {
                                            $ba = "'".str_replace("'","''",$_POST['boite'])."'";
                                        } else {
                                            $ba = 'NULL';
                                        }

                                        mysqli_query($co,"INSERT INTO personne (sexe, nom, prenom, date_naissance, mel, telfixe, telportable, telfax, telfixepro, telportablepro, telfaxpro, adresse, adresse_comp,cp,ville,quartierville,numboite_appt,statut_personne) VALUES ('$sexe','$nom','$prenom','$date',$mel, $fixeperso,$portperso,$faxperso,$fixepro,$portpro,$faxpro,$adresse,$cadresse,$cp,$ville,$qv,$ba,'Inscrit')") or die ("Création d'un membre impossible !");
                                        $id = mysqli_insert_id($co);
                                        mysqli_query($co, "INSERT INTO historiquepersonne (texte, date_historique, heure_historique, supprime, personne_concerne, compte_concerne) VALUES ('Vous avez inséré une personne : $prenom $nom',curdate(),curtime(),false,$id,$c)");

                                        header("Location: ../vues/association.php?personne=$id");
                                    }
                                }
                             }
                        }
                    }
                }
            }
        }
    } else {
        header("Location: ../vues/formulaire_nouveau_membre.php?error=9");
    }
?>