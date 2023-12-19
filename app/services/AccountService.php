<?php

class AccountService extends DataProvider implements ImAccountService {

    public function addAccount(Account $account) {
     $db=$this->connect();
     if ($db == null) {
        return null;
    }
    $accountId = $account->accountId;
    $balance = $account->balance;
    $RIB = $account->RIB;
    $userId = $account->userId;

    $sql = "INSERT INTO account (accountId ,balance , RIB , userID)
    VALUES (:accountId ,:balance , :rib , :userID)
    ";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':accountId' ,$accountId,PDO::PARAM_STR);
    $stmt->bindParam(':balance' ,$balance,PDO::PARAM_STR);
    $stmt->bindParam(':rib' ,$RIB,PDO::PARAM_STR);
    $stmt->bindParam(':userID' ,$userId,PDO::PARAM_STR);

   try{
     $stmt->execute();
    }
    catch(PDOException $e){
   die("invalid query" . $e->getMessage());
   }

   $db = null;
   $stmt = null;

    }

    public function displayAccount(){
        $db_connection = $this->connect();
            if ($db_connection == null) {
                return null;
            }
            $sql = "SELECT * FROM account";

            $stmt = $db_connection->query($sql);

            $accounts = $stmt->fetchAll(PDO::FETCH_OBJ);
            
            $db_connection = null;
            $stmt = null;

            return $accounts;


    }

    public function updateAccount(Account $account) {
        $db_connection = $this->connect();
        if ($db_connection == null) {
            return null;
        }
        
        $accountId = $account->accountId;
        $balance = $account->balance;
        $RIB = $account->RIB;
        $userId = $account->userId;

        $sql = "UPDATE account SET balance = :balance , RIB = :rib WHERE accountId = :accountID";

        $stmt = $db_connection->prepare($sql);


        $stmt->execute([
            ":balance"=> $balance,
            ":rib"=> $RIB,
            ":accountId"=> $accountId,

        ]);

        $db_connection = null;
        $stmt = null;

    }

    public function deleteAccount($accountID) {

        $db_connection = $this->connect();

        if ($db_connection == null) {
            return null;
        }

        $sql = "DELETE FROM account WHERE accountId = :accountID";

        $stmt = $db_connection->prepare($sql);

        $stmt->execute([
            ":accountID"=> $accountID,
        ]);

        $db_connection = null;
        $stmt = null;

    }












    


    

}






?>