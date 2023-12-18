<?php

class Account{
    private $accountId;
    private $balance;
    private $RIB;
    private $userId;




    public function __construct( $balance, $RIB, $userId){
     $this->accountId=uniqid(mt_rand(), true);
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