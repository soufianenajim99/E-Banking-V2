<?php

    interface IBankService {
     function displayBanks();
     function getBank($bankID);
     function addBank(Bank $bank);
     function updateBank(Bank $bank);
     function deleteBank($bankId);
    }

?>