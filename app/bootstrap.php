<?php 
session_start();

require_once 'config/config.php';

echo "boot";

function Autoloader($class) {
    $paths = [
        APPROOT."/libraries/",
        APPROOT."/services/",
        APPROOT."/models/",
        APPROOT."/security/"
    ];

    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }
}


spl_autoload_register('Autoloader');

$coreobj = new Core();


?>