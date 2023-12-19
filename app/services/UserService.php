<?php

require_once "ImUserService.php";
require_once "../config/DataProvider.php";

class UserService extends DataProvider implements ImUserService {



    public function addUser(User $user){

        $db = $this->connect();

        $userId = $user->userId;
        $username = $user->username;
        $password = $user->pw;
        $gendre = $user->gendre;
        $agencyId = $user->agencyId;

        $adrId = $user->adress->adressId;
        $ville = $user->adress->ville;
        $quartier = $user->adress->quartier;
        $rue = $user->adress->rue;
        $codePostal = $user->adress->codePostal;
        $email = $user->adress->email;
        $phone = $user->adress->phone;

        try {
            $sql = "INSERT INTO adress VALUES (:id, :city, :district, :street, :postal_code, :email, :telephone)";

            $stmt = $db->prepare($sql);

            $stmt->bindParam(":id", $adrId);
            $stmt->bindParam(":city",$ville);
            $stmt->bindParam(":district",$quartier);
            $stmt->bindParam(":street", $rue);
            $stmt->bindParam(":postal_code", $codePostal);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":telephone", $phone);

            $stmt->execute();


            $sql = "INSERT INTO users VALUES (:id, :username, :password, :gendre, :adress_id, :agency_id)";

            $stmt = $db->prepare($sql);

            $stmt->bindParam(":id", $userId);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":gendre", $gendre);
            $stmt->bindParam(":adress_id", $adrId);
            $stmt->bindParam(":agency_id", $agencyId);

            $stmt->execute();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

    }

    public function updateUser(User $user){

        $db = $this->connect();

        $userId = $user->userId;
        $username = $user->username;
        $password = $user->pw;
        $gendre = $user->gendre;
        $agencyId = $user->agencyId;

        $adrId = $user->adress->adressId;
        $ville = $user->adress->ville;
        $quartier = $user->adress->quartier;
        $rue = $user->adress->rue;
        $codePostal = $user->adress->codePostal;
        $email = $user->adress->email;
        $phone = $user->adress->phone;

        try {
            $sql = "UPDATE adress SET ville = :ville, quartier = :district, rue = :street, codePostal = :postal_code, email = :email, phone = :telephone WHERE id = :id";
            

            $stmt = $db->prepare($sql);

            $stmt->bindParam(":id", $adrId);
            $stmt->bindParam(":city",$ville);
            $stmt->bindParam(":district",$quartier);
            $stmt->bindParam(":street", $rue);
            $stmt->bindParam(":postal_code", $codePostal);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":telephone", $phone);
    

            $sql = "UPDATE users SET username = :username, pw = :password, gendre = :gendre, agencyId = :agency_id WHERE id = :id";

            $stmt = $db->prepare($sql);

            $stmt->bindParam(":id", $userId);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":gendre", $gendre);
            $stmt->bindParam(":agency_id", $agencyId);

            $stmt->execute();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

    }

    public function deleteUser($id){
        $db = $this->connect();

        try {
            $sql = "DELETE FROM users WHERE id = :id";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);

            $stmt->execute();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

    }

    public function displayUser(){
        $db = $this->connect();

        try {
            $sql = "SELECT 
            users.userId,
            users.username,
            users.agencyId,
            adress.email,
            roleofuser.roleName
         FROM users
         JOIN roleofuser ON users.userId = roleofuser.userId
         JOIN agency ON users.agencyId = agency.agencyId
         JOIN adress
         WHERE users.adrId = adress.adrId AND delete_check=1";

            $data = $db->query($sql);

            return $data->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

    }


    

  
    



}




?>