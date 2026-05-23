<?php

require_once __DIR__ . '/dbconnection.php';

mysqli_report(MYSQLI_REPORT_OFF);

$setupToken = 'smc_setup_20260523_b4f2c7d91e';
$providedToken = $_GET['token'] ?? '';

if (!hash_equals($setupToken, $providedToken)) {
    http_response_code(403);
    header('Content-Type: text/plain; charset=utf-8');
    echo "Forbidden.\n";
    exit;
}

$schemaPath = __DIR__ . '/database/schema.sql';
$schema = file_get_contents($schemaPath);

if ($schema === false) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');
    echo "Could not read database/schema.sql\n";
    exit;
}

if (!mysqli_multi_query($connection, $schema)) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');
    echo "Schema import failed: " . mysqli_error($connection) . "\n";
    exit;
}

while (true) {
    $result = mysqli_store_result($connection);
    if ($result instanceof mysqli_result) {
        mysqli_free_result($result);
    }

    if (!mysqli_more_results($connection)) {
        break;
    }

    if (!mysqli_next_result($connection)) {
        http_response_code(500);
        header('Content-Type: text/plain; charset=utf-8');
        echo "Schema import failed while processing multiple statements: " . mysqli_error($connection) . "\n";
        exit;
    }
}

if (mysqli_errno($connection) !== 0) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');
    echo "Schema import completed with an error: " . mysqli_error($connection) . "\n";
    exit;
}

$tables = [];
$result = mysqli_query($connection, 'SHOW TABLES');
if ($result instanceof mysqli_result) {
    while ($row = mysqli_fetch_row($result)) {
        $tables[] = $row[0];
    }
    mysqli_free_result($result);
}

header('Content-Type: text/plain; charset=utf-8');
echo "Schema import completed successfully.\n\n";
echo "Current tables:\n";
foreach ($tables as $table) {
    echo "- {$table}\n";
}
echo "\nRemove setup_database.php after you finish using it.\n";
