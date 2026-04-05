<?php
require_once 'essentials/db_connect.php';
try {
    $pdo->exec("ALTER TABLE settings ADD COLUMN admin_language ENUM('en', 'sq') DEFAULT 'en'");
    echo "Column admin_language added to settings table.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
