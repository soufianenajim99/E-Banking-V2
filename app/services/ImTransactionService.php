<?php

interface ImTransactionService {
    public function addTransaction(Transaction $transaction);
    public function displayTransaction();
    public function deleteTransaction($transactionid);

}


?>