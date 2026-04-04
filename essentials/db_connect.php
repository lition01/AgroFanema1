<?php
/**
 * Database Connection — AgroFanema
 * Handles connection to XAMPP MySQL (agrofanema database)
 */

$host = 'localhost';
$db   = 'agrofanema';
$user = 'root';
$pass = ''; // Default XAMPP password is empty
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
     // 1. Initial connection
     $pdo = new PDO($dsn, $user, $pass);
     
     /**
      * Using direct integer values for attributes to bypass "Undefined Constant"
      * issues in some PHP environments.
      * 19 = ATTR_ERR_MODE, 2 = ERRMODE_EXCEPTION
      * 3  = ATTR_DEFAULT_FETCH_MODE, 2 = FETCH_ASSOC
      * 20 = ATTR_EMULATE_PREPARES
      */
     $pdo->setAttribute(19, 2); 
     $pdo->setAttribute(3, 2);
     $pdo->setAttribute(20, false);

} catch (Exception $e) {
    // If the error is about a missing driver, we provide clear instructions
    $msg = $e->getMessage();
    if (strpos($msg, 'could not find driver') !== false) {
        die("FATAL ERROR: The MySQL driver for PDO is not enabled. 
             Please uncomment 'extension=pdo_mysql' in your php.ini and restart Apache.");
    }
    die("DATABASE ERROR: " . $msg);
}
?>
