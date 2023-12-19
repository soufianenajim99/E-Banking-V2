<?php

const CONFIG = [
    'db'=>'mysql:host=localhost;dbname=e-banking-v2',
    'db_user' => 'root',
    'db_password' => ''
];



class DataProvider {
    public function connect() {
        try {
            $dsn = CONFIG['db'];
            $username = CONFIG['db_user'];
            $password = CONFIG['db_password'];

            return new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            // Log or handle the exception appropriately
            error_log('Connection failed: ' . $e->getMessage());
            return null;
        }
    }
}


define('APPROOT' , dirname(dirname(__FILE__)));
define('SITENAME' , 'E-Banking');
define('URLROOT' , 'http://localhost/E-Banking-V2');

    ?>