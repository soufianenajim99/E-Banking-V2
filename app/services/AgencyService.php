<?php

require_once "../config/DataProvider.php";


class ServiceAgency extends DataProvider implements IServiceAgency
{

    public function add(Agency $agency)
    {
        $db = $this->connect();
        // Implement the method here
        $adrId = $agency->adress->adrId;
        $ville = $agency->adress->ville;
        $quartier = $agency->adress->quartier;
        $rue = $agency->adress->rue;
        $codePostal = $agency->adress->codePostal;
        $email = $agency->adress->email;
        $phone = $agency->adress->phone;

        $sql = "INSERT INTO adress VALUES (:id, :city, :district, :street, :postal_code, :email, :telephone)";

            $stmt = $db->prepare($sql);
            
            $stmt->bind(":adrId", $adrId);
            $stmt->bind(":city", $ville);
            $stmt->bind(":district", $quartier);
            $stmt->bind(":street", $rue);
            $stmt->bind(":postal_code", $codePostal);
            $stmt->bind(":email", $email);
            $stmt->bind(":telephone", $phone);
            $stmt->execute();

            $stmt->query(" INSERT INTO agency (agencyId, longitude, latitude, bankId, adrId) VALUES (:agencyId, :longitude,:latitude,:bankId,:adrId);");
            $stmt->bind(":agencyId", $agency->agencyId);
            $stmt->bind(":longitude", $agency->longitude);
            $stmt->bind(":latitude", $agency->latitude);
            $stmt->bind(":bankId", $agency->bankId);
            $stmt->bind(":adrId", $adrId);
            $stmt->execute();


    }

    public function update(Agency $agency)
    {
        $db = $this->connect();

        // Implement the method here
        $adrId = $agency->adress->adrId;
        $ville = $agency->adress->ville;
        $quartier = $agency->adress->quartier;
        $rue = $agency->adress->rue;
        $codePostal = $agency->adress->codePostal;
        $email = $agency->adress->email;
        $phone = $agency->adress->phone;

        
              $sql = "UPDATE adress SET ville = :ville, quartier = :quartier, rue = :rue, codePostal = :codePostal, email = :email, phone = :phone WHERE adrId = :adrId";

              $stmt = $db->prepare($sql);


             $stmt->bind(":id", $adrId);
             $stmt->bind(":city", $ville);
             $stmt->bind(":district", $quartier);
             $stmt->bind(":street", $rue);
             $stmt->bind(":postal_code", $codePostal);
             $stmt->bind(":email", $email);
             $stmt->bind(":telephone", $phone);
             $stmt->execute();
    
             $stmt->query("UPDATE agency SET longitude = :longitude, latitude = :latitude, bankId = :bankId, adrId = :adrId WHERE agencyId = :agencyId;");
             $stmt->bind(":agencyId", $agency->agencyId);
             $stmt->bind(":longitude", $agency->longitude);
             $stmt->bind(":latitude", $agency->latitude);
             $stmt->bind(":bankId", $agency->bankId);
             $stmt->bind(":adrId", $adrId);
             $stmt->execute();

    }

    public function display()
    {
       
        $db = $this->connect();
        
            $sql = 'SELECT 
            agency.agencyId,
            agency.longitude,
            agency.latitude,
            bank.name
            FROM agency
            JOIN bank ON agency.bankId = bank.bankId;';
         
         $data = $db->query($sql);

         return $data->fetchAll(PDO::FETCH_ASSOC);

    }

    public function delete($agencyId)
    {
        $db = $this->connect();
           $sql = "DELETE FROM agency WHERE agencyId = :agencyId ";

           $stmt = $db->prepare($sql);

           $stmt->bind(":agencyId",$agencyId);

           $stmt->execute();
    }
}

?>