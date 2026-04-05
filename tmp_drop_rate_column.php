<?php
require_once 'essentials/db_connect.php';
try {
    $pdo->exec("ALTER TABLE settings DROP COLUMN IF EXISTS eur_to_all_rate");
    echo "Column eur_to_all_rate dropped successfully if it existed.";
} catch (PDOException $e) {
    // If IF EXISTS is not supported (MySQL < 8.0)
    try {
        $pdo->exec("ALTER TABLE settings DROP COLUMN eur_to_all_rate");
        echo "Column eur_to_all_rate dropped successfully.";
    } catch (PDOException $e2) {
        echo "Note: Column might not exist or error occurred: " . $e2->getMessage();
    }
}
?>
