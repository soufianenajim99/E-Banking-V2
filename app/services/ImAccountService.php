<?php

interface ImAccountService {
    public function addAccount(Account $account);
    public function updateAccount(Account $account);
    public function displayAccount();
    public function deleteAccount($accountid);

}


?>