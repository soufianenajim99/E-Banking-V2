<?php

    require("IRoleService.php");
    require_once "../config/DataProvider.php";
   

    class RoleService extends DataProvider implements IRoleService {

        public function create(Role $role){

            $db = $this->connect();

            $userId = $role->userId;
            $roleId = $role->roleName;

            try {
                $sql = "INSERT INTO roleofuser VALUES (:userId, :roleName)";
                $stmt = $db->prepare($sql);

                $stmt->bindParam(":userId", $userId);
                $stmt->bindParam(":roleName", $roleId);
                
                $stmt->execute();
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }

        }

        public function delete($id) {

            $db = $this->connect();

            try {
                $sql = "DELETE FROM roleofuser WHERE userId = :id";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(":id", $id);
                $stmt->execute();
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }
        }

    }

?>