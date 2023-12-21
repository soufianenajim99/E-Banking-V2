<?php

    require_once "IBankService.php";
    require_once "../config/DataProvider.php";

    class BankService extends DataProvbankIder implements ImBankService {

        public function addBank(Bank $bank){

            $db = $this->connect();

            $bankId = $bank->bankId;
            $name = $bank->name;
            $logo = $bank->logo;

            try {
                $sql = "INSERT INTO bank VALUES (:bankId, :name, :logo)";
                $stmt = $db->prepare($sql); 

                $stmt->bindParam(":bankId", $bankId);
                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":logo", $logo);

                $stmt->execute();
            } catch (PDOException $e){
                die("Error: ". $e->getMessage());
            }

        }

        public function updateBank(Bank $bank){

            $db = $this->connect();

            $bankId = $bank->bankId;
            $name = $bank->name;
            $logo = $bank->logo;

            try {
                $sql = "UPDATE bank SET name = :name, logo = :logo WHERE bankId = :bankId";
                $stmt = $db->prepare($sql);

                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":logo", $logo);
                $stmt->bindParam(":bankId", $bankId);

                $stmt->execute();
            } catch (PDOException $e){
                    die("Error: " . $e->getMessage());
                
            }

        }

        public function getBank($bankID)
        {
            $db = $this->connect();
            
            $sql = "SELECT * FROM bank WHERE bankID = :bankID";
            $this->db->query($sql);
            $this->db->bind(":bankID" , $bankID);
            try {
                $bank = $this->db->oneObject();
                return $bank;
            } catch (PDOException $e) {
               return ("Faild to Get Banks" . $e->getMessage());
            }
        }


        public function deleteBank($bankId){

            $db = $this->connect();

            try {
                $sql = "DELETE FROM bank WHERE bankId = :bankId";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(":bankId", $bankId);
                $stmt->execute();
            } catch (PDOException $e){
                die("Error: " . $e->getMessage());
            }
        }

        public function displayBanks(){

            $db = $this->connect();

            try {
                $sql = "SELECT * FROM bank";
                $query = $db->query($sql);
                $data = $query->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            } catch (PDOException $e){
                die("Error: " . $e->getMessage());
            }
        }

    }