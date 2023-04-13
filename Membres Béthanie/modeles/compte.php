<?php
    require_once("../modeles/connexion.php");
	require_once("../modeles/compte.php");

    
    class Compte{
        private $co;
        private $id;
        private $login;
        private $mdp;
        private $profil;
        private $statut;
	    

        public function __construct(){
            $ctp = func_num_args();
            $args = func_get_args();

            switch ($ctp) {
                case 3:
                    $co = $args[0];
                    $login = $args[1];
                    $mdp = $args[2];

                    $result = mysqli_query($co, "SELECT id_compte, profil_compte, statut_compte FROM compte WHERE login='$login' AND mdp_crypted = sha1('$mdp')") or die("Erreur requête");

                    while ($row = mysqli_fetch_assoc($result)){
                        $this->co = $co;
                        $this->login = $login;
                        $this->mdp = $mdp;
                        $this->id = $row["id_compte"];
                        $this->profil = $row["profil_compte"];
                        $this->statut = $row['statut_compte'];
                    }
                    break;
                case 4:
                    $co = $args[0];
                    $login = $args[1];
                    $mdp = $args[2];
                    $profil = $args[3];
                    $statut = 'Créé';

                    mysqli_query($co, "INSERT INTO compte (login,mdp,mdp_crypted,profil_compte,date_creation,heure_creation, statut_compte) VALUES ('$login','$mdp',sha1('$mdp'),'$profil',curdate(),curtime(),'$statut')") or die("Erreur insertion");

                    $this->co = $co;
                    $this->id = mysqli_insert_id($co);
                    $this->login = $login;
                    $this->mdp = $mdp;
                    $this->profil = $profil;
                    $this->statut = $statut;
                    break;
            }
        }

        public function getProfil(){
            return $this->profil;
        }

        public function connexion(){
            session_start();
            $_SESSION['compte'] = $this->id;
        }

        public function deconnexion(){
            session_destroy();
            mysqli_close($this->co);
        }
    }
?>