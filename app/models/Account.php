<?php

class Account{
    private $accountId;
    private $balance;
    private $RIB;
    private $userId;


    public function __construct($accountId, $balance, $RIB, $userId){
     $this->accountId=$accountId;
     $this->balance= $balance;
     $this->RIB= $RIB;
     $this->userId=$userId;
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