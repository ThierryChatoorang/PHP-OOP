<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "statistiekensysteem";

// Maak de connectie
$conn = new mysqli($servername, $username, $password, $database);

// Controleer de connectie
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}
?>
