<?php
$servername = "localhost";
$username = "root"; // If you haven't set a password, use 'root' or the actual username
$password = ""; // Leave blank if you're using the default XAMPP setup with no password
$dbname = "your_database_name"; // Replace with the actual name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
