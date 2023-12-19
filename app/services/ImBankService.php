<?php

    interface IBankService {
        function create(Bank $bank);
        function update(Bank $bank);
        function delete($id);
        function read();
    }

?>