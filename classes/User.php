<?php
    class User {
        function __construct($nom, $prenom, $token, $role, $created_at, $update_at) {
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->token = $token;
            $this->role = $role;
            $this->created_at = $created_at;
            $this->update_at = $update_at;
        }
        // Nous créons un setter pour le nom afin que l'utilisateur puisse changer son nom
        public function setNom($nom = null) {
            if ($nom == null) {
                return $this->nom;
            }
            $this->nom = $nom;
            // nous mettons à jour la valeur de update_at avec la date et l'heure du moment de la modification
            $this->update_at = new DateTime('NOW');
            // nous retournons à true afin d'avoir un résultat à la fin de l'action
            return true;
        }
        // Nous créons un getter pour le nom afin que le programme puisse afficher le nom de l'utilisateur
        public function getNom() {
            return $this->nom;
        }
        // Nous créons un setter pour le prénom afin que l'utilisateur puisse changer son prénom
        public function setPrenom($prenom = null) {
            if ($prenom == null) {
                return $this->prenom;
            }
            $this->prenom = $prenom;
            // nous mettons à jour la valeur de update_at avec la date et l'heure du moment de la modification
            $this->update_at = new DateTime('NOW');
            // nous retournons à true afin d'avoir un résultat à la fin de l'action
            return true;
        }
        // Nous créons un getter pour le prénom afin que le programme puisse afficher le prénom de l'utilisateur
        public function getPrenom() {
            return $this->prenom;
        }
        // Nous créons un getter pour le token afin que le programme puisse récuperer le token de l'utilisateur nous ne faisons pas de getter dans ce cas là, car le token ne doit pas changer
        public function getToken() {
            return $this->token;
        }
        // Nous créons un getter pour la date de création afin que le programme puisse récuperer la date de création de l'utilisateur nous ne faisons pas de getter dans ce cas là, car cette date ne doit pas changer
        public function getCreationDate() {
            return $this->created_at;
        }
    }
?>