<?php

require_once "../config/DataProvbankIder.php";
class ServiceAtm extends DataProvider implements ImAtmService
{
    public function add(Atm $atm)
    {
        $db = $this->connect();
        // Implement the method here
        $atmId = $atm->atmId;
        $bankId = $atm->bankId;
        $latitude = $atm->latitude;
        $adress = $atm->address;
        $longitude = $atm->longitude;

        try{
            $this->db->query("INSERT INTO atm (atmId, adress, longitude, latitude, bankId) VALUES (:id, :adress, :longitude, :latitude, :bankId)");
            $this->db->bind(":id", $atmId);
            $this->db->bind(":adress", $adress);
            $this->db->bind(":longitude", $longitude);
            $this->db->bind(":latitude", $latitude);
            $this->db->bind(":bankId", $bankId);
            $this->db->execute();
        } catch(Exception $e){
            die("Error" . $e->getMessage());
        }
    }

    public function update(Atm $atm)
    {
        // Implement the method here
        try {
            $this->db->query("UPDATE atm SET adress = :adress, longitude = :longitude, latitude = :latitude WHERE atmId = :id");
            // $stmt = $this->connect()->prepare($sql);
            $this->db->bind(":adress", $atm->adress);
            $this->db->bind(":longitude", $atm->longitude);
            $this->db->bind(":latitude", $atm->latitude);
            $this->db->bind(":id", $atm->id);
            $this->db->execute();
        } catch (PDOException $e){
                die("Error: " . $e->getMessage());
            
        }
    }

    public function display()
    {
        // Implement the method here
        try {
            $this->db->query("SELECT * FROM atm");
            // $query = $this->connect()->query($sql);
            // $data = $query->fetchAll(PDO::FETCH_ASSOC);
            $data = $this->db->resultSet();
            return $data;
        } catch (PDOException $e){
            die("Error: " . $e->getMessage());
        }
    }

    public function delete($atmId)
    {
        // Implement the method here
        try {
            $this->db->query("DELETE FROM atm WHERE atmId = :id");
            // $stmt = $this->connect()->prepare($sql);
            $this->db->bind(":id", $atmId);
            $this->db->execute();
        } catch (PDOException $e){
            die("Error: " . $e->getMessage());
        }
    }

}

?>