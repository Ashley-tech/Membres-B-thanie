<?php
    class Membre{
        private $co;
        private $id;
        private $sexe;
        private $nom;
        private $prenom;
        private $naissance;
        private $mail;
        private $fixeperso;
        private $portableperso;
        private $faxperso;
        private $fixepro;
        private $portablepro;
        private $faxpro;
        private $adresse;
        private $complement;
        private $code_postal;
        private $ville;
        private $boite;
        private $quartier;

        public function __construct(){
            $args = func_get_args();
            $co = $args[0];
            $sexe = $args[1];
            $nom = $args[2];
            $prenom = $args[3];
        }

        public function afficherMembre($id){
            
        }

        public function setSexe($sexe){
            $this->sexe = $sexe;
        }
    }
?>