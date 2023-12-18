<?php

class RoleUser{
    private $userId;
    private $roleName;

    public function __construct($userId,$roleName){
        $this->userId = $userId;
        $this->roleName = $roleName;
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