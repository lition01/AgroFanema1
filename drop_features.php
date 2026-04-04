<?php
require_once 'essentials/db_connect.php';
try {
    $pdo->exec("DROP TABLE IF EXISTS product_features");
    echo "Table product_features dropped successfully.";
} catch (Exception $e) {
    echo "Error dropping table: " . $e->getMessage();
}
?>
