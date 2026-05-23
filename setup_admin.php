<?php

require_once __DIR__ . '/dbconnection.php';

$setupToken = 'smc_admin_20260523_d18f74a62c';
$providedToken = $_GET['token'] ?? '';

if (!hash_equals($setupToken, $providedToken)) {
    http_response_code(403);
    header('Content-Type: text/plain; charset=utf-8');
    echo "Forbidden.\n";
    exit;
}

$username = 'admin';
$plainPassword = '12345';
$hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

$checkSql = "SELECT Userid FROM usertb WHERE Username = 'admin' LIMIT 1";
$checkResult = mysqli_query($connection, $checkSql);

if ($checkResult instanceof mysqli_result && mysqli_num_rows($checkResult) > 0) {
    mysqli_free_result($checkResult);

    $updateSql = "UPDATE usertb
        SET Firstname='Admin',
            Surname='User',
            Gender='NotSay',
            PhoneNumber='',
            DOB=NULL,
            Email='admin@example.com',
            Address='',
            Password='" . mysqli_real_escape_string($connection, $hashedPassword) . "',
            Country='Myanmar',
            Profile='',
            Role='Admin',
            Remark='Seeded admin account'
        WHERE Username='admin'";

    if (!mysqli_query($connection, $updateSql)) {
        http_response_code(500);
        header('Content-Type: text/plain; charset=utf-8');
        echo "Failed to update admin user: " . mysqli_error($connection) . "\n";
        exit;
    }

    header('Content-Type: text/plain; charset=utf-8');
    echo "Admin user updated successfully.\n";
    echo "Username: admin\n";
    echo "Password: 12345\n";
    echo "Role: Admin\n";
    echo "Remove setup_admin.php after login works.\n";
    exit;
}

if ($checkResult instanceof mysqli_result) {
    mysqli_free_result($checkResult);
}

$insertSql = "INSERT INTO usertb
    (Firstname, Surname, Gender, PhoneNumber, DOB, Email, Address, Username, Password, Country, Profile, SignupDate, Role, Remark)
    VALUES
    ('Admin', 'User', 'NotSay', '', NULL, 'admin@example.com', '', 'admin', '" . mysqli_real_escape_string($connection, $hashedPassword) . "', 'Myanmar', '', NOW(), 'Admin', 'Seeded admin account')";

if (!mysqli_query($connection, $insertSql)) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');
    echo "Failed to create admin user: " . mysqli_error($connection) . "\n";
    exit;
}

header('Content-Type: text/plain; charset=utf-8');
echo "Admin user created successfully.\n";
echo "Username: admin\n";
echo "Password: 12345\n";
echo "Role: Admin\n";
echo "Remove setup_admin.php after login works.\n";
