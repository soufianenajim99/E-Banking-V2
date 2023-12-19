<?php

class TransactionService extends DataProvider implements ImTransactionService {

    public function addTransaction(Transaction $transaction){
        $db=$this->connect();
        if($db==null){
            return null;
       }

       $transactionId = $transaction->transactionId;
       $type = $transaction->type;
       $amount = $transaction->balance;
       $accountId = $transaction->accountId;

       
       $sql= 'INSERT INTO transactions (transactionId ,type, amount, accountId) VALUES (:accountId, :type, :amount, :accountId)';
       $stmt = $db->prepare($sql);
       $stmt->execute([
        ":type" => $type,
        ":amount" => $amount,
        ":accountId"=> $accountId,
        ":transactionId"=> $transactionId,

       ]);
       $db=null;
       $stmt=null;
    }

    public function displayTransaction(){
            $db=$this->connect();
            if($db==null){
                return null;
           }
        
           $query = $db->query('SELECT transactions.*, users.username
           FROM transactions
           JOIN account ON transactions.accountId = account.accountId
           JOIN users ON account.userId = users.userId;
           ');
        
           $data_trans=$query->fetchAll(PDO::FETCH_OBJ);
        
           $query = null;
           $db=null;
           return $data_trans;
    }
    public function deleteTransaction($transactionid){


        $db = $this->connect();

        if($db == null) {
            return null;
        }
    
        $sql = "DELETE FROM transactions WHERE transactionId = :id";
    
        $smt = $db->prepare($sql);
    
        $smt->execute([
            ":id" => $transactionid,
        ]);
    
        $smt = null;
        $db = null;

    }






}





?>