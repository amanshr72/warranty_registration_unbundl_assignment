<?php
function connectToDatabase() {
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'warranty_registration';
    // $host = 'sql206.infinityfree.com';
    // $username = 'if0_35751212';
    // $password = 'StWoprJmc0';
    // $database = 'if0_35751212_warranty_registration';
    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>
