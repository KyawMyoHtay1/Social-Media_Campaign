<?php

require_once __DIR__ . '/config.php';

$config = get_db_config();
$connection = mysqli_connect(
    $config['host'],
    $config['username'],
    $config['password'],
    '',
    (int) $config['port']
);

if ($connection) {
    echo "Database Connected!";
} else {
    echo "Connection Fail!";
}

$databaseName = $config['database'];
$sql = "create database if not exists `$databaseName`";

if (mysqli_query($connection, $sql)) {
    echo "Database is created!";
} else {
    echo "Creation Database Error!";
}

?>
