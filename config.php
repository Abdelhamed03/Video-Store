<?php
$servername = "localhost";
$username = "root";          // MySQL root user
$password = "";              // Your MySQL root password
$dbname = "movie_rental_system";  // The database we created earlier

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

