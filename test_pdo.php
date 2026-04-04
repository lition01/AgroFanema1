<?php
if (!extension_loaded('pdo')) {
    echo "PDO core extension is NOT loaded.\n";
} else {
    echo "PDO core is loaded.\n";
}

if (!extension_loaded('pdo_mysql')) {
    echo "PDO MySQL driver is NOT loaded.\n";
} else {
    echo "PDO MySQL is loaded.\n";
}

phpinfo();
?>
