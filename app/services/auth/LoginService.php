<?php
//  require_once APPROOT . '/libraries/Database.php';
 
class LoginService implements LoginInterface{

    public function fetchUserByUsernameAndPass($username , $password){
        $db = new Database();
        $sql = "SELECT userID , username , userPass FROM users WHERE username = :username AND userPass = :userPass";

        $db->query($sql);
        $db->bind(":username" , $username);
        $db->bind(":userPass" , $password);
        try {
            $fetchUser = $db->oneObject();
            return $fetchUser;
        } catch (PDOException $e) {
            $error = die("Failed to Find User" . $e->getMessage());
            return $error;     
        }


    }
    
    public function getRoleOfUSer($userID)
    {
        $db = new Database();
        $sql = "SELECT roleName FROM roleofuser WHERE userID = :userID";

        $db->query($sql);
        $db->bind(":userID", $userID);
        try {
            $roleOfUser = $db->oneObject();
            return $roleOfUser;
        } catch (PDOException $e) {
            $error = die("Failed to Find Role of User" . $e->getMessage());
            return $error;
        }






    }


}