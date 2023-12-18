<?php

require_once "/app/services/ImUserService.php";
require_once "/app/config/DataProvider.php";

class UserService extends DataProvider implements ImUserService {

    public function addUser(User $user){
        $db=$this->connect();
    }
}




?>