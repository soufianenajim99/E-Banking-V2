<?php

class Transaction{
    private $transactionId;
    private $type;
    private $amount;
    private $accountId;

    public function __construct($type,$amount,$accountId){
        
       $this->transactionId = uniqid(mt_rand(), true);
       $this->type = $type;
       $this->amount = $amount;
       $this->accountId = $accountId;
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