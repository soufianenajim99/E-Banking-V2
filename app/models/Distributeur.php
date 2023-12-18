<?php

class Distributeur{
    private $atmId;
    private $longitude;
    private $latitude;
    private $adress;
    private $bankId;

    public function __construct($atmId,$longitude,$latitude,$bankId,$adress){

        $this->atmId = $atmId;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->adress = $adress;
        $this->bankId = $bankId;
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