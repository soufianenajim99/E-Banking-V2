<?php

class Bank{
    private $bankId;
    private $name;
    private $logo;

    public function __construct($name,$logo){

        $this->bankId = uniqid(mt_rand(), true);
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