<?php

class Agency{
    private $agencyid;
    private $longitude;
    private $latitude;
    private $bankId;
    private Adress $adress;

    public function __construct($agencyid,$longitude,$latitude,$bankId,Adress $adress){

        $this->agencyid = $agencyid;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->bankId = $bankId;
        $this->adress = $adress;
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