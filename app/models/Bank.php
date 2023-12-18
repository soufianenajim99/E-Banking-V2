<?php

class Bank{
    private $bankId;
    private $name;
    private $logo;

    public function __construct($bankId,$name,$logo){

        $this->bankId = $bankId;
        $this->name = $name;
        $this->logo = $logo;
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