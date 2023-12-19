<?php

require_once "../config/DataProvider.php";
class ServiceAtm extends DataProvider implements ImAtmService
{
    public function add(Distributeur $atm)
    {
        $db = $this->connect();
     
        $atmId = $atm->atmId;
        $bankId = $atm->bankId;
        $latitude = $atm->latitude;
        $adress = $atm->adress;
        $longitude = $atm->longitude;

        $sql = "INSERT INTO atm (atmId, adress, longitude, latitude, bankId) VALUES (:id, :adress, :longitude, :latitude, :bankId)";

        $stmt = $db->prepare($sql);
     
        $stmt->bind(":id", $atmId);
        $stmt->bind(":adress", $adress);
        $stmt->bind(":longitude", $longitude);
        $stmt->bind(":latitude", $latitude);
        $stmt->bind(":bankId", $bankId);
        $stmt->execute();
     

    }

    public function update(Distributeur $atm)
    {
        
            $db = $this->connect();
        
            $sql = "UPDATE atm SET adress = :adress, longitude = :longitude, latitude = :latitude WHERE atmId = :id";
            $stmt = $db->prepare($sql);
            $stmt->bind(":adress", $atm->adress);
            $stmt->bind(":longitude", $atm->longitude);
            $stmt->bind(":latitude", $atm->latitude);
            $stmt->bind(":id", $atm->id);
            $stmt->execute();
       
    }

    public function display()
    {
        $db = $this->connect();

    
            $sql = "SELECT * FROM atm";
           $stmt = $db->query($sql);
            $data =  $stmt->fetchAll(PDO::FETCH_OBJ);
            return $data;
       
      
    }

    public function delete($atmId)
    {
        $db = $this->connect();

        $sql = "DELETE FROM atm WHERE atmId = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $atmId);
        $stmt->execute();
       
    }

}

?>