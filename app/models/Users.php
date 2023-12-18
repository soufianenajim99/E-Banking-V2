<?php

    class User {
        private $id;
        private $username;
        private $password;
        private $nationality;
        private $gendre;
        private Adress $adress;
        private $agencyId;
        private $timestamp;

        public function __construct($username, $password, $nationality, $gendre,Adress $adress, $agencyId, $timestamp){
            $this->id = uniqid(mt_rand(), true);
            $this->username = $username;
            $this->password = $password;
            $this->nationality = $nationality;
            $this->gendre = $gendre;
            $this->adress = $adress;
            $this->agencyId = $agencyId;
            $this->timestamp = $timestamp;
        }

        public function __get($property) {
            if (property_exists($this, $property)) {
              return $this->$property;
            }
        }

        public function __set($property, $value) {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }

        }
    }

?>