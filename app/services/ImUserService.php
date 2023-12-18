<?php

interface ImUserService {
    public function addUser(user $user);
    public function displayUser();
    public function deleteUser($userid);

}


?>