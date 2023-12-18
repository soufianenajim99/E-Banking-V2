<?php

interface ImUserService {
    public function addUser(User $user);
    public function updateUser(User $user);
    public function displayUser();
    public function deleteUser($userid);

}


?>