<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "assignment";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");

// Switch to the created database
$conn->select_db($dbname);

// Create table login_details
$query = "CREATE TABLE IF NOT EXISTS login_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

$conn->query($query);
?>
