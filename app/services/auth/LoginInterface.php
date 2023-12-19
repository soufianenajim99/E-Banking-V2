<?php 
interface LoginInterface {
    
    public function fetchUserByUsernameAndPass($username , $password);
    public function getRoleOfUSer($userID);

}