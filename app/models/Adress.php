<?php

class Adress{
    private $adressId;
    private $ville;
    private $quartier;
    private $rue;
    private $codePostal;
    private $email;
    private $phone;

    private $timestamp;


    public function __construct($adressId, $ville, $quartier, $rue, $codePostal, $email, $phone){
            $this->adressId = $adressId;
            $this->ville = $$ville;
            $this->quartier = $quartier;
            $this->rue = $rue;
            $this->codePostal = $codePostal;
            $this->email = $email;
            $this->phone = $phone;
            // $this->timestamp = $timestamp;
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